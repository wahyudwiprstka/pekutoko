<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class IpaymuService
{
  public function createPayment($data)
  {
    try {
      $timestamp = Carbon::now()->format('YmdHis');
      $httpMethod = 'POST';
      $vaNumber = env('IPAYMU_VA');
      $apiKey = env('IPAYMU_API_KEY');

      $body = [
        'product' => $data['product'],
        'qty' => $data['qty'],
        'price' => $data['price'],
        'description' => $data['description'],
        'returnUrl' => $data['returnUrl'],
        'notifyUrl' => $data['notifyUrl'],
        'cancelUrl' => $data['cancelUrl'],
        'buyerName' => $data['buyerName'],
      ];

      $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
      $requestBody  = strtolower(hash('sha256', $jsonBody));
      $stringToSign = strtoupper($httpMethod) . ':' . $vaNumber . ':' . $requestBody . ':' . $apiKey;
      $signature    = hash_hmac('sha256', $stringToSign, $apiKey);

      $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'signature' => $signature,
        'va' => $vaNumber,
        'timestamp' => $timestamp,
      ])->post(env('IPAYMU_URL') . '/api/v2/payment', $body);

      $redirectUrl = $response->json()['Data']['Url'];

      if (!$redirectUrl) {
        throw 'redirect url not found';
      }

      return $redirectUrl;
    } catch (\Throwable $th) {
      return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
    }
  }
}

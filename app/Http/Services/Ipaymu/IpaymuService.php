<?php

namespace App\Services\Ipaymu;

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
        'product' => $data['products'],
        'qty' => $data['qty'],
        'price' => $data['price'],
        'description' => $data['description'],
        'imageUrl' => $data['imageUrl'],
        'referenceId' => $data['referenceId'],
        'returnUrl' => $data['returnUrl'],
        'notifyUrl' => $data['notifyUrl'],
        'cancelUrl' => $data['cancelUrl'],
        'buyerName' => $data['buyerName'],
        'paymentMethod' => $data['paymentMethod']
      ];

      $requestBody = json_encode($body);
      $hashedBody = strtolower(hash('sha256', $requestBody));
      $stringToSign = "{$httpMethod}:{$vaNumber}:{$hashedBody}:{$apiKey}";

      $signature = hash_hmac('sha256', $stringToSign, $apiKey);

      $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'signature' => $signature,
        'va' => $vaNumber,
        'timestamp' => $timestamp,
      ])->post(env('IPAYMU_URL') . '/api/v2/payment', $body);

      return $response->json();

      return response()->json(['status' => 'success']);
    } catch (\Throwable $th) {
      return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
    }
  }
}

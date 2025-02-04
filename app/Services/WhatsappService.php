<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;

class WhatsappService
{

  protected $baseUrl;
  protected $token;
  protected $secret;

  public function __construct()
  {
    $this->baseUrl = env('WABLAS_BASE_URL');
    $this->token = env('WABLAS_TOKEN'); // Token disimpan di file .env
    $this->secret = env('WABLAS_SECRET'); // Token disimpan di file .env
  }

  /**
   * Kirim pesan WhatsApp
   *
   * @param string $phone
   * @param string $message
   * @return mixed
   * @throws Exception
   */
  public function sendMessage(string $phone, string $message)
  {
    // $curl = curl_init();
    // $url = "{$this->baseUrl}?phone={$phone}&message=" . urlencode($message) . "&token={$this->token}." . $this->secret;

    // curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Agar hasil bisa dikembalikan
    // $result = curl_exec($curl);

    // if (curl_errno($curl)) {
    //   throw new Exception('Error: ' . curl_error($curl));
    // }

    // curl_close($curl);

    // return json_decode($result, true); // Mengembalikan hasil sebagai array

    // =================================================================

    $curl = curl_init();
    $payload = [
        "data" => [
            [
                'phone' => $phone,
                'message' => $message,
            ]
        ]
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Authorization: $this->token.$this->secret",
            "Content-Type: application/json"
        )
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
    curl_setopt($curl, CURLOPT_URL,  "https://tegal.wablas.com/api/v2/send-message");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result, true); // Mengembalikan hasil sebagai array
  }
}


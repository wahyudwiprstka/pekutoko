<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WhatsappService
{

  protected $baseUrl;
  protected $token;

  public function __construct()
  {
    $this->baseUrl = env('WABLAS_BASE_URL');
    $this->token = env('WABLAS_TOKEN'); // Token disimpan di file .env
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
    $curl = curl_init();
    $url = "{$this->baseUrl}?phone={$phone}&message=" . urlencode($message) . "&token={$this->token}";

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Agar hasil bisa dikembalikan
    $result = curl_exec($curl);

    if (curl_errno($curl)) {
      throw new Exception('Error: ' . curl_error($curl));
    }

    curl_close($curl);

    return json_decode($result, true); // Mengembalikan hasil sebagai array
  }
}

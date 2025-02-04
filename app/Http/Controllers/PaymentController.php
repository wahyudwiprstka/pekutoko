<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
  function __construct(
    protected WhatsappService $whatsappService
  ) {}

  public function updateStatusOrder(Request $request)
  {
    // Validasi data request
    $validatedData = $request->validate([
      'sid' => 'required|string',
    ]);

    try {
      // Log request untuk debugging (opsional)
      Log::info('Callback diterima', $validatedData);

      // Cari transaksi berdasarkan ssid
      $transactions = Order::where('session_id', $validatedData['sid'])->get();

      if ($transactions->isEmpty()) {
        return response()->json([
          'success' => false,
          'message' => 'Transaksi tidak ditemukan.',
        ], 404);
      }

      // Perbarui status semua transaksi yang ditemukan
      if($request['status_code'] == 1){
        foreach ($transactions as $transaction) {
          $transaction->update([
            'order_status' => 1,
          ]);
        }
      }

      // foreach ($transactions as $transaction) {
      //   $transaction->update([
      //     'order_status' => 1,
      //   ]);
      // }


      // Kirim pesan WhatsApp ke setiap pelanggan
      if($request['status_code'] == 1){
        $this->whatsappService->sendMessage($transactions[0]->phone_number, "Pembayaran dengan nomor order " . $transactions[0]->order_number . " berhasil, penjual akan mengirim produknya." );
      }
      
      // Kirim respon sukses
      return response()->json([
        'code' => 200,
        'success' => true,
        'message' => 'Status pembayaran berhasil diperbarui.',
      ]);
    } catch (\Exception $e) {
      // Log error untuk debugging
      Log::error('Error saat memproses callback: ' . $e->getMessage());

      // Respon error
      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan saat memproses data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
}

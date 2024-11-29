<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Services\WhatsappService;

class OrderController extends Controller
{

  function __construct(
    protected WhatsappService $whatsappService
  ) {}
  public function index()
  {
    if (session('userRole') == 'admin' || session('userRole') == 'superadmin') {
      $orders = Order::all();
    } else {
      $user = User::find(auth()->user()->id);
      $orders = Order::where('id_ukm', $user->ukm->id)->get();
    }
    return view('admin.order.index', compact('orders'));
  }

  public function show($id)
  {
    $order = Order::find($id);

    $products = json_decode($order->order_detail, true);
    return view('admin.order.show', compact('order', 'products'));
  }

  // make update order
  public function update(Request $request, $id)
  {
    $order = Order::find($id);
    $order->update($request->all());
    $message = "";

    switch ($request->order_status) {
      case 2:
        $message = "Pesanan dengan nomor order " . $order->id . " telah dikirim";
        break;
      case 3:
        $message = "Pesanan dengan nomor order " . $order->id . " telah selesai";
        break;
      default:
        $message = "Pesanan dengan nomor order " . $order->id . " telah dibatalkan";
        break;
    }

    $this->whatsappService->sendMessage($order->phone_number, $message);
    return redirect()->route('order.show', $id);
  }
}

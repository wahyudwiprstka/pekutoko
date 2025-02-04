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
  public function index(Request $request)
  {
    if (session('userRole') == 'admin' || session('userRole') == 'superadmin') {
      if($request["tanggal_awal"] && $request["tanggal_akhir"]){
        $orders = Order::where('created_at', '>=', $request["tanggal_awal"])->where('created_at', '<=', $request["tanggal_akhir"])->get();
      }else{
        $orders = Order::all();
      }
    } else {
      $user = User::find(auth()->user()->id);
      if($request["tanggal_awal"] && $request["tanggal_akhir"]){
        $orders = Order::where('id_ukm', $user->ukm->id)->whereDate('created_at', '>=', $request["tanggal_awal"])->whereDate('created_at', '<=', $request["tanggal_akhir"])->get();
      }else{
        $orders = Order::where('id_ukm', $user->ukm->id)->get();
      }
    }

    $tanggal_awal = $request['tanggal_awal'];
    $tanggal_akhir = $request['tanggal_akhir'];
    return view('admin.order.index', compact('orders', 'tanggal_awal', 'tanggal_akhir'));
  }

  public function show($id, Request $request)
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
        $message = "Pesanan dengan nomor order " . $order->order_number . " telah dikirim";
        break;
      case 3:
        $message = "Pesanan dengan nomor order " . $order->order_number . " telah selesai";
        break;
      default:
        $message = "Pesanan dengan nomor order " . $order->order_number . " telah dibatalkan";
        break;
    }

    $this->whatsappService->sendMessage($order->phone_number, $message);
    return redirect()->route('order.show', $id);
  }
}

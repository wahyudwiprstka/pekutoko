<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
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
}

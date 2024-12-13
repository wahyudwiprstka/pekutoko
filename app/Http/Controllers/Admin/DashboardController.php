<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Ukm;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    function index(): mixed
    {
        $countUkm = Ukm::count();
        $countProduct = Product::count();
        $countPendapatan = Order::selectRaw('SUM(total_price) as pendapatan')
            ->where('order_status', 3)
            ->first();
        $penjualan = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as pendapatan')
            ->whereYear('created_at', date('Y'))
            ->where('order_status', 3)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as totalOrder')
        ->whereYear('created_at', date('Y'))
        ->where('order_status', 3)
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        
        $labels = [];
        $data = [];
        $dataOrder = [];

        for($i = 1; $i <= 12; $i++){
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $count = 0;
            $orderCount = 0;

            foreach($penjualan as $p){
                if($p->month == $i){
                    $count = $p->pendapatan;
                    break;
                }
            }

            foreach($orders as $order){
                if($order->month == $i){
                    $orderCount = $order->totalOrder;
                    break;
                }
            }

            array_push($labels, $month);
            array_push($data, $count);
            array_push($dataOrder, $orderCount);
        }

        $datasets = [
            [
                'label' => 'Pendapatan',
                'data' => $data,
                'backgroundColor' => '#008cff',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
                'fill' => false,
            ]
        ];

        $datasetsOrder = [
            [
                'label' => 'Order',
                'data' => $dataOrder,
                'backgroundColor' => '#008cff',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
                'fill' => false,
            ]
        ];
        return view('admin.dashboard.index', compact('countUkm', 'countProduct', 'countPendapatan', 'datasets', 'datasetsOrder', 'labels', 'penjualan', 'orders'));
    }

    function dashboardUMKM(): mixed
    {
        $user = User::find(auth()->user()->id);
        $countProduct = Product::where('id_ukm', $user->ukm->id)->count();
        $countPendapatan = Order::selectRaw('SUM(total_price) as pendapatan')
            ->where('order_status', 3)
            ->where('id_ukm', $user->ukm->id)
            ->first();
        $penjualan = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as pendapatan')
            ->whereYear('created_at', date('Y'))
            ->where('order_status', 3)
            ->where('id_ukm', $user->ukm->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as totalOrder')
        ->whereYear('created_at', date('Y'))
        ->where('order_status', 3)
        ->where('id_ukm', $user->ukm->id)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $countOrders = Order::where('id_ukm', $user->ukm->id)
            ->count();

        $ordersBerhasil = Order::where('order_status', 3)
            ->where('id_ukm', $user->ukm->id)
            ->count();

        $orderSedangKirim = Order::where('order_status', 2)
            ->where('id_ukm', $user->ukm->id)
            ->count();

        $orderBelumProses = Order::where('order_status', 1)
            ->where('id_ukm', $user->ukm->id)
            ->count();

        $labels = [];
        $data = [];
        $dataOrder = [];

        for($i = 1; $i <= 12; $i++){
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $count = 0;
            $orderCount = 0;

            foreach($penjualan as $p){
                if($p->month == $i){
                    $count = $p->pendapatan;
                    break;
                }
            }

            foreach($orders as $order){
                if($order->month == $i){
                    $orderCount = $order->totalOrder;
                    break;
                }
            }

            array_push($labels, $month);
            array_push($data, $count);
            array_push($dataOrder, $orderCount);
        }

        $datasets = [
            [
                'label' => 'Pendapatan',
                'data' => $data,
                'backgroundColor' => '#008cff',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
                'fill' => false,
            ]
        ];

        $datasetsOrder = [
            [
                'label' => 'Order',
                'data' => $dataOrder,
                'backgroundColor' => '#008cff',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
                'fill' => false,
            ]
        ];
        return view('admin.dashboard.dashboardUMKM', compact('countProduct', 'countPendapatan', 'datasets', 'datasetsOrder', 'labels', 'penjualan', 'orders', 'ordersBerhasil', 'countOrders', 'orderBelumProses', 'orderSedangKirim'));
    }
}

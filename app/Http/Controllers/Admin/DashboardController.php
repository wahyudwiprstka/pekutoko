<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ukm;
use App\Models\Product;

class DashboardController extends Controller
{
    function index(): mixed
    {
        $countUkm = Ukm::count();
        $countProduct = Product::count();
        return view('admin.dashboard.index', compact('countUkm', 'countProduct'));
    }
}

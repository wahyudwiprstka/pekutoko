<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IpaymuService;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
  public function updateStatusOrder(Request $request)
  {
    dd($request->all());
  }
}

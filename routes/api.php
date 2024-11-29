<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::post('/update-status-order', [PaymentController::class, 'updateStatusOrder']);



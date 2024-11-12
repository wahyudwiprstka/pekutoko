<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ukm',
        'full_name',
        'address',
        'regency',
        'postal_code',
        'phone_number',
        'email',
        'notes',
        'order_detail',
        'total_price',
        'order_status',
    ];
}

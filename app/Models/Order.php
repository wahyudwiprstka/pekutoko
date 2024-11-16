<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const WAITING_PAYMENT = 0;
    public const WAITING_SEND = 1;
    public const COMPLETE = 2;
    public const CANCEL = 3;

    protected $fillable = [
        'id_ukm',
        'order_number',
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
        'session_id',
    ];

    public function ukm()
    {
        return $this->belongsTo(Ukm::class, 'id_ukm');
    }

    public function getOrderStatusText()
    {
        switch ($this->order_status) {
            case self::WAITING_PAYMENT:
                return 'Menunggu Pembayaran';
            case self::WAITING_SEND:
                return 'Menunggu Pengiriman';
            case self::COMPLETE:
                return 'Selesai';
            case self::CANCEL:
                return 'Dibatalkan';
            default:
                return 'Status Tidak Dikenal';
        }
    }
}

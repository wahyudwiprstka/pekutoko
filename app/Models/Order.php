<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const WAITING_PAYMENT = 0;
    public const WAITING_SEND = 1;
    public const SENDING = 2;
    public const COMPLETE = 3;
    public const CANCEL = 4;

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
        return match ($this->order_status) {
            self::WAITING_PAYMENT => 'Menunggu Pembayaran',
            self::WAITING_SEND => 'Menunggu Kirim',
            self::SENDING => 'Sedang Dikirim',
            self::COMPLETE => 'Selesai',
            self::CANCEL => 'Dibatalkan',
            default => 'Unknown',
        };
    }
}

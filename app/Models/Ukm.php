<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    protected $table = 'ukm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'ukm_name',
        'ukm_address',
        'wa_pic',
        'ukm_email',
        'ukm_status'
    ];

    public function user(): mixed
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}

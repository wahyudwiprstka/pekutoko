<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    const PENDING = 0;
    const ACTIVE = 1;
    const REJECTED = 2;
    const NON_AKTIF = 3;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_ukm',
        'id_category',
        'id_satuan',
        'product_name',
        'description',
        'price',
        'product_status',
        'jml_jual_per_satuan'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }

    public function ukm()
    {
        return $this->belongsTo(Ukm::class, 'id_ukm');
    }
}

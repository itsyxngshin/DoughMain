<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $table = 'stock_movements';
    protected $fillable = [
        'id',
        'product_id',
        'quantity',
        'change_date',
        'remarks',
        'movement_type', // 'in' or 'out'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

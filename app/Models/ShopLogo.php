<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopLogo extends Model
{
    protected $table = 'shop_logos';
    protected $fillable = [
        'id',
        'directory',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopLogo extends Model
{
    protected $table = 'shop_logos';
    protected $fillable = [
        'id',
        'logo_path',
    ];

    public function shop()
    {
        return $this->hasOne(Shop::class, 'shop_id', 'id');
    }
}

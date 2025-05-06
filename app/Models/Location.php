<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = [
        'region',
        'city',
        'province',
        'barangay',
        'street',
        'landmark',
        'longitude',
        'latitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function shop()
{
    return $this->hasOne(Shop::class, 'shop_address_id');
}


}

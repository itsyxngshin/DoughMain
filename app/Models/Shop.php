<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = [
        'shop_name',
        'location',
        'manage_id',
        'contact_number',
        'email_address',
    ];

    /*public function owner()
    {
        return $this->belongsTo(User::class, 'manage_id', 'id');
    }*/
   
    public function products()
    {
        return $this->hasMany(Product::class, 'shop_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'shop_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'shop_id', 'id');
    }
    public function shopLogo()
    {
        return $this->belongsTo(ShopLogo::class, 'shop_logo_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    
}

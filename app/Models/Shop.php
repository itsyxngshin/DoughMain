<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = [
        'shop_name',
        'shop_address_id',
        'manage_id',
        'shop_logo_id',
        'shop_description',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'manage_id'); // 'manage_id' references the 'id' in the 'users' table
    }
    public function paymentDetails()
{
    return $this->hasMany(ShopPaymentDetail::class);
}
    public function location()
{
    return $this->belongsTo(Location::class, 'shop_address_id');  // Make sure it's using the correct foreign key
}


    
    
}

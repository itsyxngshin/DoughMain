<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'mode_of_payment_id',
        'account_number',
        'account_name',
        'status',
    ];

    // Relationships
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function modeOfPayment()
    {
        return $this->belongsTo(ModeOfPayment::class);
    }
}
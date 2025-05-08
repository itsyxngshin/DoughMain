<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeOfPayment extends Model
{
    protected $table = 'mode_of_payments';
    protected $fillable = [
        'payment_method',
        'description',
    ];

    public function payments()
    {
        return $this->hasMany(ModeOfPayment::class, 'payment_method_id', 'id');
    }
    public function shopPaymentDetails()
{
    return $this->hasMany(ShopPaymentDetail::class, 'mode_of_payment_id');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'payment_method_id',
        'provider_transc_id',
        'provider_intend_id',
        'amount',
        'provider_response', 
        'provider_response_code',
        'payment_method',
        'status',
    ];
    
    public function order()
    {
        return $this->belongsTo(User::class, 'order_id', 'id');
    }

    public function mode_of_payment()
    {
        return $this->belongsTo(ModeOfPayment::class, 'payment_method_id', 'id');
    }
}

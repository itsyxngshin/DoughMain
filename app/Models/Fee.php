<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fees';
    protected $fillable = [
        'order_id',
        'type',
        'amount',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}

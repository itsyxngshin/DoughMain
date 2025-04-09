<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Credential extends Model
{
    protected $table = 'credentials';
    protected $fillable = [
        'id',
        'email_address',
        'password',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Credential extends Authenticatable
{
    protected $table = 'credentials';
    protected $fillable = [
        'id',
        'email_address',
        'password',
        'phone_number',
    ];
    protected $hidden = ['password'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

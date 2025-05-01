<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'category_name',
        'description',
        'category_photo'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id', 'category_photo');
    }
    
}

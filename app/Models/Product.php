<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'shop_id',
        'product_name',
        'product_description',
        'product_image',
        'product_price',
        'status',
        'stock_id',
        'stock',
        'category_id',
        'price',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }
    public function stock(){
        return $this->hasOne(Stock::class); 
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
    
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'product_id', 'id');
    }

    public function getRemainingStockAttribute()
    {
        $stockIn = $this->stockMovements()->where('movement_type', 'in')->sum('quantity');
        $stockOut = $this->stockMovements()->where('movement_type', 'out')->sum('quantity');
        return $stockIn - $stockOut;
    }

    public function getTotalSoldAttribute()
    {
        return $this->stockMovements->where('movement_type', 'out')->sum('quantity');
    }
    
    public function scopeSearch($query, $search)
    {
        return $query->where('product_name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
    }
    public function scopeFilterByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
    public function scopeFilterByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }
    public function scopeSortByPrice($query, $direction = 'asc')
    {
        return $query->orderBy('price', $direction);
    }
    public function scopeSortByName($query, $direction = 'asc')
    {
        return $query->orderBy('product_name', $direction);
    }
}


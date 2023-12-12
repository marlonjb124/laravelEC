<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "product_id";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'price', 'description', 'stock','category','image'
    ];
    // Relación con Orden_Producto
    public function ordenProducto()
    {
        return $this->hasMany(OrdenProducto::class, 'product_id', 'product_id');
    }

    // Relación con Cart_Product
    public function cartProduct()
    {
        return $this->hasMany(CartProduct::class, 'product_id', 'product_id');
    }
    public function favoritedByUsers()
    {
    return $this->belongsToMany(User::class, 'favorite_products', 'product_id', 'user_id')->withTimestamps();
    }
}

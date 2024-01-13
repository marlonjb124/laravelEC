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
        'price', 'description', 'stock','category','image',"descuento","habilitado","cantVentas"
    ];
    // Relación con Orden_Producto
     // Mutator para el atributo actualPrice
     protected static function boot()
     {
         parent::boot();
 
         static::saving(function ($product) {
             // Calcula el actualPrice basado en el descuento y el precio
             $product->actualPrice = $product->price -  ($product->descuento / 100) * $product->price;
         });
     }


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
    return $this->belongsToMany(User::class, 'favorite_products', 'product_id', 'user_id');
    }
}

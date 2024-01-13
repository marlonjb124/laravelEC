<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = "cart_product";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "cart_id","product_id","quantity"
     ];
    // Relación con Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    // Relación con Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public function getTotalAttribute()
    {
        return $this->quantity * $this->product->price; 
    }
    
}


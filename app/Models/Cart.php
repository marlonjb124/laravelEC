<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";
    protected $primaryKey = "cart_id";
    public $timestamps = false;
    protected $fillable = [
        "cart_id","user_id"
    ];
    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relación con Cart_Product
    public function cartProduct()
    {
        return $this->hasMany(CartProduct::class, 'cart_id', 'cart_id');
    }
}

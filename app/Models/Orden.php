<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = "orden";
    protected $primaryKey = "orden_id";
    public $timestamps = false;
    protected $fillable = [
       "user_id","date","estado","direccionEnvio","precioTotal"
    ];
    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::creating(function ($orden) {
    //         // Recalcula el precioTotal sumando los precios de los productos asociados
    //         $precioTotal = 0;
    //         echo($orden->ordenProducto->product->price);
    //         foreach ($orden->ordenProducto as $ordenProducto) {
    //             //El error esta aqui
    //             echo($ordenProducto->product->price) ;
    //             $precioTotal += $ordenProducto->product->price;
    //         }
            
    //         $orden->precioTotal = $precioTotal;
      
    //     });
    // }
    
    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relación con Orden_Producto
    public function ordenProducto()
    {
        return $this->hasMany(OrdenProducto::class, 'orden_id', 'orden_id');
    }
}

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
       "user_id","date","estado"
    ];
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenProducto extends Model
{
    use HasFactory;

    protected $table = "orden_producto";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "orden_id","product_id"
     ];
    // Relación con Orden
    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id', 'orden_id');
    }

    // Relación con Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = "perfil";
    public $incrementing = false; // Establecer en false si no es una clave primaria autoincremental
    protected $primaryKey = "user_id";
    public $timestamps = false;

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

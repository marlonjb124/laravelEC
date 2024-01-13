<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = "perfiles";
    public $incrementing = false; 
    protected $primaryKey = "user_id";
    public $timestamps = false;

    protected $fillable = ["name","surname","address","phone","user_id","credit_card","profile_pic"];
    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, AuthenticatableTrait;

    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;

     protected $fillable = [
        'name',
        'email', 'password', 'rol', 'enabled'
    ];

    // Relación con Perfil
    public function perfil(): BelongsTo
    {
        return $this->belongsTo(Perfil::class, 'user_id', 'id');
    }

    // Relación con Orden
    public function orden(): HasMany
    {
        return $this->hasMany(Orden::class, 'user_id', 'id');
    }

    // Relación con Cart
    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
}



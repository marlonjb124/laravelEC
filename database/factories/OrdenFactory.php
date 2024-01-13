<?php

// database/factories/OrdenFactory.php

namespace Database\Factories;

use App\Models\Orden;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdenFactory extends Factory
{
    protected $model = Orden::class;

    public function definition()
    {
        // Obtén un usuario aleatorio
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'date' => $this->faker->dateTimeThisMonth,
            'estado' => $this->faker->randomElement(['pendiente', 'completada', 'cancelada']),
            'precioTotal' => $this->faker->randomNumber(4),
            "direccionEnvio"=> $this->faker->text(10),
        ];
    }
}


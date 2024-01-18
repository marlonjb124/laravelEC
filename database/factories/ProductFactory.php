<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    // protected $arregloCDM = ["public\\images\\ventana.jpg","public\\images\\puerta.jpg"];

    public function definition()
    {
      
            return [
                'name' =>  $this->faker->randomElement(["Ventanas", 'Puertas']),
                'description' => $this->faker->text(20),
                'category' => "Conformacion de metales",
                'price' => $this->faker->randomFloat(2, 50, 1500),
                'stock' => $this->faker->numberBetween(5, 200),
                "image"=> $this->faker->randomElement(["public\images\\ventana.jpg","public\images\puerta.jpg"]),
                "descuento"=>$this->faker->randomFloat(2, 50, 90),
                'habilitado' => $this->faker->boolean,
                "cantVentas"=>0
            ];
        
    }

    // Puedes agregar más métodos para definir productos específicos, por ejemplo:
    // public function CDM()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'name' =>  $this->faker->randomElement(["Ventanas", 'Puertas']),
    //             'description' => $this->faker->sentence,
    //             'category' => "Conformacion de metales",
    //             'price' => $this->faker->randomFloat(2, 50, 1500),
    //             'stock' => $this->faker->numberBetween(5, 200),
    //             "image"=> "",
    //             "descuento"=>$this->faker->randomFloat(2, 50, 90),
    //             'habilitado' => $this->faker->boolean,
    //             "cantVentas"=>0
    //         ];
    //     });
    // }

    public function Manualidades()
    {
       
            return [
                'name' => $this->faker->randomElement(['carpeta', 'Cajas de cumpleaños']),
                'description' => $this->faker->text(20),
                'category' => "Manualidades",
                'price' => $this->faker->randomFloat(2, 50, 1500),
                'stock' => $this->faker->numberBetween(5, 200),
                "image"=>  $this->faker->randomElement(["public\images\carpeta.png","public\images\carpeta.png"]),
                "descuento"=>$this->faker->randomFloat(2, 50, 90),
                'habilitado' => $this->faker->boolean,
                "cantVentas"=>0
            ];
    
    }

    public function MDC()
    {
       
            return [
                'name' => $this->faker->randomElement(["bloque","tanques de agua"]),
                'description' => $this->faker->text(20),
                'category' => "Materiales de Construccion",
                'price' => $this->faker->randomFloat(2, 50, 1500),
                'stock' => $this->faker->numberBetween(5, 200),
                "image"=> $this->faker->randomElement(["public\images\bloque.jpg","public\images\\tanque.jpg"]),
                "descuento"=>$this->faker->randomFloat(2, 50, 90),
                'habilitado' => $this->faker->boolean,
                "cantVentas"=>0
            ];
       
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->ean13(),
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'imagen' => $this->faker->imageUrl(640, 480, 'products', true),
            'stock' => $this->faker->numberBetween(10,100),
            'precio_compra' => $this->faker->randomFloat(0,10,500),
            'precio_venta' => $this->faker->randomFloat(0,20,600),
            'fecha_ingreso' => $this->faker->date(),
            'categoria_id' => 5,
            'empresa_id' => 1,
        ];
    }
}

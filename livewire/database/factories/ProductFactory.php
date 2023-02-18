<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sedia= ['Tersedia', 'Tidak Tersedia'];
        // $img= ['https://source.unsplash.com/300x300/?food','https://source.unsplash.com/300x300/?animal','https://source.unsplash.com/300x300/?dessert','https://source.unsplash.com/300x300/?cake'];
        
        return [
            'produk' => $this->faker->word(),
            'harga' => $this->faker->randomNumber(4, true),
            // 'gambar' => $this->faker->randomElement($img),
            'status' => $this->faker->randomElement($sedia)            
        ];
    }
}

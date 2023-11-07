<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Map>
 */
class MapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(),
            'deskripsi' => fake()->paragraphs(3, true),
            'latitude' => fake()->latitude(-7.3657937435453595, -7.4774601967571535),
            'longitude' => fake()->longitude(-250.80654144287112, -250.5088806152344),
            'kategori_id' => rand(1, 3)
        ];
    }
}

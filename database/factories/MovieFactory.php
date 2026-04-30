<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->regexify('tt[0-9]{7}'),
            'judul' => $this->faker->sentence,
            'sinopsis' => $this->faker->paragraph,
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? 1,
            'tahun' => $this->faker->year,
            'pemain' => $this->faker->sentence,
            'foto_sampul' => 'default.jpg',
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concert>
 */
class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' =>$this->faker->sentence(3),
           'description' =>$this->faker->text(25),
           'date' =>$this->faker->date('Y-m-d'), // Formato de fecha
           'duration' => $this->faker->time('H:i:s'),
           'image'=>'/img/example.png'
        ];
    }
}

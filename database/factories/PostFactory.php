<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'title' => $this->faker->sentence(5),
         'description'=> $this->faker->paragraph(),
         'body' => $this->faker->text(2000),
         'tags' => implode(', ', $this->faker->words(5)),
         'header_image' => $this->faker->url()
        ];
    }
}

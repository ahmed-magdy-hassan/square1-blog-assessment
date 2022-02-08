<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(5, true),
        ];
    }

    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'publication_date' => $this->faker->date(),
            ];
        });
    }

    public function unPublished()
    {
        return $this->state(function (array $attributes) {
            return [
                'publication_date' => now()->addDays(rand(1, 10)),
            ];
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'event_status_id' => 4,
            'name' => $this->faker->name(),
            'date' => $this->faker->dateTimeBetween('+ 1 months', '+3 months'),
            'descr' => $this->faker->text(),
            'image' => $this->faker->imageUrl(620, 405, 'animals')
        ];
    }
}

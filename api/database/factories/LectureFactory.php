<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecture>
 */
class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(5,true);
        $preview_image = 'https://via.placeholder.com/600/5F113B/FFFFFF/?text=Lecture.'.$title.'*';
        return [
            'title' => $title,
            'link' => 'https://www.youtube.com/watch?v=USjZcfj8yxE',
            'preview_image' => $preview_image,
            'created' => $this->faker->dateTimeBetween('-1 years'),
        ];
    }
}

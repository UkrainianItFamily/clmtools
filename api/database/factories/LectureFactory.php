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
        return [
            'title' => $this->faker->sentence(5,true),
            'link' => 'https://www.youtube.com/watch?v=USjZcfj8yxE',
            'preview_image' => config('constants.thumbnail.empty').'Lecture*',
        ];
    }
}

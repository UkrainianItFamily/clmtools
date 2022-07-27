<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $user = \App\Models\User::factory()->create([
             'name' => 'Test',
             'last_name' => 'User',
             'email' => 'test@example.com',
             'phone' => '111111111111',
             'lecturer' => true
         ]);

        \App\Models\Course::factory(3)->create([
            'user_id' => $user->id
        ])->each(function($course) {
            \App\Models\Lecture::factory(3)->create([
                'user_id' => $course->user_id,
                'course_id' => $course->id,
                'author_id' => $course->user_id,
            ]);
        });
    }
}

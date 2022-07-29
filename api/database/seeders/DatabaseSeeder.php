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
        $this->call(CitySeeder::class);
        $this->call(UniversitySeeder::class);

        $lecturer = \App\Models\User::factory()->create([
             'name' => 'Lecturer',
             'last_name' => 'User',
             'email' => 'lecturer@example.com',
             'phone' => '111111111111',
             'city' => null,
             'university' => null,
             'lecturer' => true
         ]);

        \App\Models\Course::factory(3)->create([
            'user_id' => $lecturer->id
        ])->each(function($course) {
            \App\Models\Lecture::factory(3)->create([
                'course_id' => $course->id,
                'author_id' => $course->user_id,
            ]);
        });

    }
}

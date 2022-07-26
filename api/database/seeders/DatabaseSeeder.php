<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\University;
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

        \App\Models\Lecture::factory(3)->create([
            'user_id' => $user->id,
        ]);


        $this->call(CitySeeder::class);
        $this->call(UniversitySeeder::class);
    }
}

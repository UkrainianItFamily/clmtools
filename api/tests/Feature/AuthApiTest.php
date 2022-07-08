<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;

class AuthApiTest extends TestCase
{
    private $email = 'test@example.com';
    private $password = 'Ye4oKoEa3Ro9llC';
    private $api_url = '/api/v1/login';

    public function test_existent_user()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => Str::random(5).'@'.Str::random(5).'.com',
            'password' => bcrypt($this->password),
        ]);

        $response = $this->postJson($this->api_url, [
            'email' => $user->email,
            'password' => $this->password
        ]);

        $response
            ->assertStatus(200)
            ->assertSeeText('access_token');

        User::destroy($user->id);
    }

    public function test_non_existent_user()
    {
        $response = $this->postJson($this->api_url, [
            'email' => Str::random(15).'@mail.com',
            'password' => $this->password
        ]);

        $response
            ->assertStatus(400)
            ->assertSeeText('error');
    }

    public function test_incorrect_data_request()
    {
        $response = $this->postJson($this->api_url, [
            'email' => Str::random(10),
            'password' => $this->password
        ]);

        $response
            ->assertStatus(422)
            ->assertSeeText('error');
    }

    public function test_seven_character_password()
    {
        $response = $this->postJson($this->api_url, [
            'email' => $this->email,
            'password' => Str::random(7)
        ]);

        $response
            ->assertStatus(422)
            ->assertSeeText('error');
    }
}


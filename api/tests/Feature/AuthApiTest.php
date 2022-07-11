<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthApiTest extends TestCase
{
    private $email;
    private $password;
    private $api_url;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->email = 'test@example.com';
        $this->password = 'Ye4oKoEa3Ro9llC';
        $this->api_url = '/api/v1/login';
    }

    public function test_existing_user()
    {
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => Str::random(5).'@'.Str::random(5).'.com',
            'password' => Hash::make($this->password),
        ]);

        $response = $this->postJson($this->api_url, [
            'email' => $this->user->email,
            'password' => $this->password
        ]);

        $response
            ->assertStatus(200)
            ->assertSeeText('access_token');

        User::destroy($this->user->id);
    }

    public function test_nonexistent_user()
    {
        $response = $this->postJson($this->api_url, [
            'email' => Str::random(15).'@mail.com',
            'password' => $this->password
        ]);

        $response
            ->assertJsonFragment(['message' => 'Unauthorized'])
            ->assertStatus(400);
    }

    public function test_incorrect_email()
    {
        $response = $this->postJson($this->api_url, [
            'email' => Str::random(10),
            'password' => $this->password
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(['email' => ["The email must be a valid email address."]]);
    }

    public function test_incorrect_password()
    {
        $response = $this->postJson($this->api_url, [
            'email' => $this->email,
            'password' => Str::substr($this->password, 0, 8),
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(['password' => ["The password must be at least 8 characters."]]);
    }
}

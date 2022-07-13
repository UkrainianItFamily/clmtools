<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationApiTest extends TestCase
{
    private string $register_api_url;
    private mixed $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->register_api_url = 'api/v1/auth/register';
        $this->user = User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => 'testuser@example.com',
            'phone' => '380951122333',
            'password' => Hash::make('Smith123456'),
        ]);
    }

    public function tearDown(): void
    {
        User::destroy($this->user->id);
    }

    public function test_required_fields_for_registration()
    {
        $response = $this->postJson($this->register_api_url, []);

        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "The name field is required. (and 4 more errors)",
                "errors" => [
                    "name" => ["The name field is required."],
                    "last_name" => ["The last name field is required."],
                    "email" => ["The email field is required."],
                    "phone" => ["The phone field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function test_email_already_taken()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Smith",
            "email" => "testuser@example.com",
            "phone" => "380951122444",
            "password" => "Smith123456",
            "password_confirmation" => "Smith123456",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["email" => ["The email has already been taken."]]);
    }

    public function test_phone_already_taken()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Smith",
            "email" => "john@example.com",
            "phone" => "380951122333",
            "password" => "Smith123456",
            "password_confirmation" => "Smith123456",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["phone" => ["The phone has already been taken."]]);
    }

    public function test_repeat_password()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Smith",
            "email" => "john@example.com",
            "phone" => "380951122555",
            "password" => "Smith123456",
            "password_confirmation" => "Smith",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["password" => ["The password confirmation does not match."]]);
    }

    public function test_incorrect_password()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Smith",
            "email" => "john@example.com",
            "phone" => "380951122555",
            "password" => "smith",
            "password_confirmation" => "smith",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                "password" => [
                    "The password must be at least 8 characters.",
                    "The password must contain at least one uppercase and one lowercase letter.",
                    "The password must contain at least one number."
                ]
            ]);
    }

    public function test_incorrect_phone()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Smith",
            "email" => "john@example.com",
            "phone" => Str::random(11),
            "password" => "Smith123456",
            "password_confirmation" => "Smith123456",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["phone" => ["The phone format is invalid."]]);
    }

    public function test_incorrect_email()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Smith",
            "email" => "john-example.com",
            "phone" => "380951122555",
            "password" => "Smith123456",
            "password_confirmation" => "Smith123456",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["email" => ["The email must be a valid email address."]]);
    }
}

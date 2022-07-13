<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationApiTest extends TestCase
{
    private string $register_api_url;

    public function setUp(): void
    {
        parent::setUp();
        $this->register_api_url = 'api/v1/auth/register';
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
}

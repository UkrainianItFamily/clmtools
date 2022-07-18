<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Tests\TestCase;

class ForgotPasswordApiTest extends TestCase
{
    use RefreshDatabase;

    private string $forgot_api_url;
    private string $email;
    private mixed $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->forgot_api_url = 'api/v1/auth/forgot-password';
        $this->email = Str::random(5).'@'.Str::random(5).'.com';
        $this->user = User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => $this->email,
            'phone' => '380951122333',
            'password' => Hash::make('RandomPassword123'),
        ]);
    }

    public function TearDown(): void
    {
        $this->forgot_api_url = null;
        $this->email = null;
        User::destroy($this->user->id);
    }

    public function test_forgot_email_send_success()
    {
        $response = $this->postJson($this->forgot_api_url, [
            'email' => $this->user->email
        ]);

        $response
            ->assertStatus(200)
            ->assertSeeText(['msg' => 'Ми надіслали ваше посилання для зміни пароля електронною поштою!']);
    }

    public function test_user_not_exist()
    {
        $response = $this->postJson($this->forgot_api_url, [
            'email' => $this->user->email
        ]);

        $response
            ->assertStatus(422)
            ->assertSeeText(['message' => 'Даний e-mail не існує.']);
    }

    public function test_required_fields_for_forgot_password()
    {
        $response = $this->postJson($this->forgot_api_url, []);

        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "Поле e-mail обов'язкове.",
                "errors" => [
                    "email" => ["Поле e-mail обов'язкове."],
                ]
            ]);
    }

    public function test_incorrect_email()
    {
        $Data = ["email" => "john-example.com"];

        $response = $this->postJson($this->forgot_api_url, $Data);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["email" => ["e-mail має бути дійсною електронною адресою."]]);
    }

}

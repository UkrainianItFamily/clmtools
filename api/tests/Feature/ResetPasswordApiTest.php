<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class ResetPasswordApiTest extends TestCase
{
    use RefreshDatabase;

    private string $reset_api_url;
    private string $email;
    private string $token;
    private string $password;
    private string $password_confirmation;
    private mixed $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->reset_api_url = 'api/v1/auth/reset';
        $this->email = Str::random(5).'@'.Str::random(5).'.com';
        $this->token = Str::random(64);
        $this->password = 'RandomPassword123';
        $this->password_confirmation = 'RandomPassword123';
        $this->user = User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => $this->email,
            'phone' => '380951122333',
            'password' => Hash::make('RandomPassword123'),
        ]);

        DB::table('password_resets')->insert([
            'email' => $this->email,
            'token' => $this->token,
            'created_at' => Carbon::now()
        ]);

    }

    public function TearDown(): void
    {
        $this->reset_api_url = '';
        $this->email = '';
        $this->token = '';
        $this->password = '';
        $this->password_confirmation = '';
        User::destroy($this->user->id);

        DB::table('password_resets')->where(['email'=> $this->email])->delete();
    }

    public function test_required_fields_for_reset()
    {
        $Data = [
            'email' => $this->email,
            'token' => $this->token
        ];
        $response = $this->postJson($this->reset_api_url, $Data);

        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "Поле пароль обов'язкове.",
                "errors" => [
                    "password" => ["Поле пароль обов'язкове."],
                ]
            ]);
    }

    public function test_repeat_password()
    {
        $Data = [
            'email' => $this->email,
            'token' => $this->token,
            'password'=> $this->password,
            'password_confirmation'=> 'WrongPassword123'
        ];
        $response = $this->postJson($this->reset_api_url, $Data);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["password" => ["Підтвердження пароль не збігається."]]);
    }

    public function test_length_password()
    {
        $Data = [
            'email' => $this->email,
            'token' => $this->token,
            'password'=> 'Wrong1',
            'password_confirmation'=> 'Wrong1'
        ];
        $response = $this->postJson($this->reset_api_url, $Data);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["password" => ["пароль має бути не менше ніж 8 символів."]]);
    }

    public function test_mixed_case_password()
    {
        $Data = [
            'email' => $this->email,
            'token' => $this->token,
            'password'=> 'wrongpassword1',
            'password_confirmation'=> 'wrongpassword1'
        ];
        $response = $this->postJson($this->reset_api_url, $Data);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["password" => ["пароль має містити щонайменше одну велику та одну малу літери."]]);
    }

    public function test_number_password()
    {
        $Data = [
            'email' => $this->email,
            'token' => $this->token,
            'password'=> 'WrongPassword',
            'password_confirmation'=> 'WrongPassword'
        ];
        $response = $this->postJson($this->reset_api_url, $Data);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(["password" => ["пароль має містити щонайменше одну цифру."]]);
    }

    public function test_successful_reset()
    {
        $Data = [
            'email' => $this->email,
            'token' => $this->token,
            'password'=> $this->password,
            'password_confirmation'=> $this->password_confirmation
        ];
        $response = $this->postJson($this->reset_api_url, $Data);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(["msg" => ["Ваш пароль скинуто!"]]);
    }

    public function test_reset_password_expired_token()
    {
        DB::table('password_resets')->where(['email' => $this->email])->delete();
        $Data = [
            'email' => $this->email,
            'token' => $this->token,
            'password'=> $this->password,
            'password_confirmation'=> $this->password_confirmation
        ];
        $response = $this->postJson($this->reset_api_url, $Data);

        $response
            ->assertStatus(400)
            ->assertJsonFragment(["message" => ["Цей токен скидання пароля недійсний."]]);
    }

}

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

class RegistrationApiTest extends TestCase
{
    use RefreshDatabase;

    private string $register_api_url;
    private string $resend_url;
    private mixed $user;
    private mixed $user_not_verified;
    private mixed $user_not_verified_two;

    public function setUp(): void
    {
        parent::setUp();

        $this->register_api_url = 'api/v1/auth/register';
        $this->resend_url = 'api/v1/email/resend';

        $this->user = User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => 'testuser@example.com',
            'phone' => '380951122333',
            'password' => Hash::make('Smith123456'),
        ]);

        $this->user_not_verified = User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => 'testnotverified@example.com',
            'phone' => '380951122999',
            'password' => Hash::make('Smith123456'),
            'email_verified_at' => NULL
        ]);

        $this->user_not_verified_two = User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => 'testnotverified2@example.com',
            'phone' => '380951122888',
            'password' => Hash::make('Smith123456'),
            'email_verified_at' => NULL
        ]);
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

    public function test_incorrect_name_and_last_name()
    {
        $userData = [
            "name" => "Jo",
            "last_name" => "Sm",
            "email" => "john@example.com",
            "phone" => "380951122555",
            "password" => "Smith123456",
            "password_confirmation" => "Smith123456",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                "name" => ["The name must be at least 3 characters."],
                "last_name" => ["The last name must be at least 3 characters."]
            ]);
    }

    public function test_successful_registration()
    {
        $userData = [
            "name" => "John",
            "last_name" => "Smith",
            "email" => "johnsuccess@example.com",
            "phone" => "380951122555",
            "password" => "Smith123456",
            "password_confirmation" => "Smith123456",
        ];

        $response = $this->postJson($this->register_api_url, $userData);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    "id",
                    "email",
                    "name",
                    "last_name",
                    "phone",
                    "email_verified_at",
                ],
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }

    public function test_resend_email_verify_success()
    {
        $user = User::find($this->user_not_verified->id);
        Auth::login($user);

        $response = $this->postJson($this->resend_url);

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    "msg" => __('register.email_verification_link_sent_on_your_email')
                ]
            );
    }

    public function test_resend_email_verify_already_verified()
    {
        $user = User::find($this->user->id);
        Auth::login($user);

        $response = $this->postJson($this->resend_url);

        $response
            ->assertStatus(400)
            ->assertJson(
                [
                    "error" => [
                        "message" => __('register.email_already_verified'),
                        "code" => 400
                    ]
                ]
            );
    }

    public function test_email_verify_expired_url()
    {
        $user = User::find($this->user_not_verified->id);
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(-1),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        $parse = parse_url($verifyUrl);
        $parsedUrl = $parse['path'] . '?' . $parse['query'];

        $response = $this->postJson($parsedUrl);

        $response
            ->assertStatus(400)
            ->assertJson(
                [
                    "error" => [
                        "message" => __('register.expired_url_provided'),
                        "code" => 401
                    ]
                ]
            );
    }

    public function test_email_verify_invalid_url()
    {
        $user = User::find($this->user_not_verified->id);
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        $parse = parse_url($verifyUrl);
        $parsedUrl = $parse['path'] . '?' . $parse['query'];

        $response = $this->postJson(substr($parsedUrl,0,-1));

        $response
            ->assertStatus(400)
            ->assertJson(
                [
                    "error" => [
                        "message" => __('register.invalid_url_provided'),
                        "code" => 401
                    ]
                ]
            );
    }

    public function test_email_verify_success()
    {
        $user = User::find($this->user_not_verified_two->id);
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        $parse = parse_url($verifyUrl);
        $parsedUrl = $parse['path'] . '?' . $parse['query'];

        $response = $this->postJson($parsedUrl);

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    "msg" => __('register.user_successfully_verified')
                ]
            );
    }
}

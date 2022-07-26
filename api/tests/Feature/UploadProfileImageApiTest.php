<?php

namespace Tests\Feature;

use App\Http\Presenters\UserArrayPresenter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UploadProfileImageApiTest extends TestCase
{
    private string $api_url;
    private mixed $file;
    private mixed $user;


    public function setUp(): void
    {
        parent::setUp();
        $this->api_url = 'api/v1/auth/me/image';
        $this->file = UploadedFile::fake()->create('my_avatar',3072,'image/jpeg');
        $this->user = User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => $this->email,
            'phone' => '380951122333',
            'password' => Hash::make('RandomPassword123'),
            'email_verified_at' => Carbon::now(),
        ]);
        auth()->loginUsingId($this->user->id);
    }

    public function TearDown(): void
    {
        $this->api_url = null;
        $this->file = null;
        User::destroy($this->user->id);
        auth()->logout();
    }

    public function test_image_upload_success()
    {
        $response = $this->postJson($this->api_url, [
            'image' => $this->file
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $this->user->id,
                'avatar' => $this->user->profile_image,
                'email' => $this->user->email,
                'name' => $this->user->name,
                'last_name' => $this->user->last_name,
                'date_birth' => $this->user->date_birth,
                'phone' => $this->user->phone,
                'email_verified_at' => $this->user->email_verified_at,
                'city' => $this->user->city,
                'university' => $this->user->university,
                'graduation_year' => $this->user->graduation_year,
                'lecturer' => $this->user->lecturer,
        ]);
    }

    public function test_image_size()
    {
        $this->file = UploadedFile::fake()->create('my_avatar',6000,'image/jpeg');
        $response = $this->postJson($this->api_url, [
            'image' => $this->file
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(([
                "message" => __('validation.size.file',['attribute' => 'image','size' => '5120']),
                "errors" => [
                    "image" => [__('validation.size.file',['attribute' => 'image','size' => '5120'])],
                ]
            ]));
    }

    public function test_file_for_image()
    {
        $this->file = UploadedFile::fake()->create('my_avatar',3000,'application/pdf');
        $response = $this->postJson($this->api_url, [
            'file' => $this->file
        ]);

        $response
            ->assertStatus(422)
            ->assertJson(([
                "message" => __('validation.image',['attribute' => 'image']),
                "errors" => [
                    "image" => [__('validation.image',['attribute' => 'image'])],
                ]
            ]));
    }

    public function test_image_required()
    {
        $this->file = '';
        $response = $this->postJson($this->api_url, [
            'file' => $this->file
        ]);

        $response
            ->assertStatus(422)
            ->assertJson(([
                "message" => __('validation.required',['attribute' => 'image']),
                "errors" => [
                    "image" => [__('validation.required',['attribute' => 'image'])],
                ]
            ]));
    }

}

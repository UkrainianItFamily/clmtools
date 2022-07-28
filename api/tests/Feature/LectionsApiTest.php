<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{User, Lecture};
use Illuminate\Support\Facades\Hash;

class LectionsApiTest extends TestCase
{
    private $lecture_collection_url;
    private $non_number_lecture_url;
    private $lecture_url;
    private $lecture;
    private $title;
    private $user;


    public function setUp(): void
    {
        parent::setUp();
        $this->title = 'Test title for manual testing';
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'example@example.example',
            'phone' => '9999999999999',
            'password' => Hash::make('Ye4oKoEa3Ro9llC'),
        ]);

        $this->lecture = Lecture::factory()->create([
            'author_id' => $this->user->id,
            'title' => $this->title,
        ]);
        $this->lecture_url = '/api/v1/lecture/'. $this->lecture->id;
    }

    public function tearDown(): void
    {
        Lecture::destroy($this->lecture->id);
        User::destroy($this->user->id);
        $this->refreshApplication();
    }

    public function test_getting_lecture()
    {
        $this->actingAs($this->user);
        $response = $this->postJson($this->lecture_url);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title' => $this->title]);
    }

    public function test_getting_collection_lectures()
    {
        $this->actingAs($this->user);
        $this->lecture_collection_url = '/api/v1/user-lectures/'. $this->user->id;
        $response = $this->postJson($this->lecture_collection_url);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title' => $this->title]);
    }

    public function test_unauthorized_user()
    {
        $response = $this->postJson($this->lecture_url);

        $response
            ->assertJsonFragment(['error' => __('authorize.unauthorized')])
            ->assertStatus(400);
    }

    public function test_empty_user_lectures()
    {
        $this->actingAs($this->user);
        $this->lecture_collection_url = '/api/v1/user-lectures/9999999';
        $response = $this->postJson($this->lecture_collection_url);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([]);
    }

    public function test_incorrect_id()
    {
        $this->actingAs($this->user);
        $response = $this->postJson($this->lecture_url . '9999999');

        $response->assertStatus(404);
    }

    public function test_non_number_id()
    {
        $this->non_number_lecture_url = '/api/v1/lecture/abc';
        $this->actingAs($this->user);
        $response = $this->postJson($this->non_number_lecture_url);

        $response->assertStatus(404);
    }
}

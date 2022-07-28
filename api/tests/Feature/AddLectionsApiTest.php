<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{User, Lecture, Course};
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddLectionsApiTest extends TestCase
{
    use RefreshDatabase;

    private $lecture_url;
    private $title;
    private $student;
    private $course;
    private $link;
    private $lecturer;

    public function setUp(): void
    {
        parent::setUp();
        $this->title = 'Test title for manual testing';
        $this->lecture_url = '/api/v1/form-lecture/';
        $this->link = 'https://www.youtube.com/watch?v=ZUMQEkoF1_c';
        $this->lecturer = \App\Models\User::factory()->create([
            'lecturer' => true
        ]);
        $this->course = \App\Models\Course::factory()->create([
            'user_id' => $this->lecturer->id
        ]);
        $this->student = \App\Models\User::factory()->create([
            'lecturer' => false
        ]);
    }

    public function tearDown(): void
    {
        $this->refreshApplication();
    }

    public function test_create_lecture()
    {
        $this->actingAs($this->lecturer);
        $response = $this->postJson($this->lecture_url, [
            'title' => $this->title,
            'description' => $this->title,
            'link' => $this->link,
            'course_id' => $this->course->id,
            'user_id' => [$this->student->id],
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title' => $this->title]);
    }

    public function test_student_create_lecture()
    {
        $this->actingAs($this->student);
        $response = $this->postJson($this->lecture_url, [
            'title' => $this->title,
            'description' => $this->title,
            'link' => $this->link,
            'course_id' => $this->course->id,
            'user_id' => [$this->student->id],
        ]);

        $response
            ->assertJsonFragment(['message' => __('authorize.forbidden_by_role')])
            ->assertStatus(400);
    }

    public function test_unauthorized_create_lecture()
    {
        $response = $this->postJson($this->lecture_url);

        $response
            ->assertJsonFragment(['error' => __('authorize.unauthorized')])
            ->assertStatus(400);
    }

    public function test_create_lecture_with_empty_users()
    {
        $this->actingAs($this->lecturer);
        $response = $this->postJson($this->lecture_url, [
            'title' => $this->title,
            'description' => $this->title,
            'link' => $this->link,
            'course_id' => $this->course->id,
            'user_id' => '',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(['message' => __('validation.required')]);
    }

    public function test_create_lecture_incorrect_course_id()
    {
        $this->actingAs($this->lecturer);
        $response = $this->postJson($this->lecture_url, [
            'title' => $this->title,
            'description' => $this->title,
            'link' => $this->link,
            'course_id' => 'test',
            'user_id' => [$this->student->id],
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment(['message' => __('validation.numeric')]);
    }
}

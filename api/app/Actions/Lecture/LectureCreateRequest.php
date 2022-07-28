<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

final class LectureCreateRequest
{
    public function __construct(
        private string $title,
        private string $description,
        private string $link,
        private int $course_id,
        private array $user_id
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getCourseId(): int
    {
        return $this->course_id;
    }

    public function getUserId(): array
    {
        return $this->user_id;
    }
}

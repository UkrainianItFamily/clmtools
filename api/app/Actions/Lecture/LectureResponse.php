<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

final class LectureResponse
{
    public function __construct(
        private object $lecture,
    ) {
    }

    public function getLecture(): object
    {
        return $this->lecture;
    }

    public function getLectureTitle(): ?string
    {
        return $this->lecture->title;
    }

    public function getLectureImage(): ?string
    {
        return $this->lecture->preview_image;
    }

    public function getLectureLink(): ?string
    {
        return $this->lecture->link;
    }

    public function getLectureDate(): string
    {
        return $this->lecture->created_at;
    }
}

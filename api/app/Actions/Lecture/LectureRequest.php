<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

final class LectureRequest
{
    public function __construct(
        private int $lecture_id
    ) {
    }

    public function getLectureId(): int
    {
        return $this->lecture_id;
    }
}

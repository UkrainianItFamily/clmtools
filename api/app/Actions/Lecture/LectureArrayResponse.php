<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

final class LectureArrayResponse
{
    public function __construct(
        private $lecture,
    ) {
    }

    public function getLecture()
    {
        return $this->lecture;
    }
}

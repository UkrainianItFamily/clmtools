<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

final class LectureCollectionRequest
{
    public function __construct(
        private int $user_id
    ) {
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}

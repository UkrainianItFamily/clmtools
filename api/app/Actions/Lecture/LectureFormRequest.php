<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

final class LectureFormRequest
{
    public function getAuthUserId(): int
    {
        return \Auth::id();
    }
}

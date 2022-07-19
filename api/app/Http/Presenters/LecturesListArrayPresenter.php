<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Lecture\LectureArrayResponse;

final class LecturesListArrayPresenter
{
    public function present(LectureArrayResponse $lecture): array
    {
        return [
            'lectures' => $lecture->getLecture()
        ];
    }
}

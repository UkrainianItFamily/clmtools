<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Lecture\LectureResponse;

final class LecturesListArrayPresenter
{
    public function present(LectureResponse $lecture): array
    {
        return [
            'lectures' => $lecture->getLecture()
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\University;

final class UniversityArrayPresenter
{
    public function present(University $university): array
    {
        return [
            'id' => $university->getId(),
            'name' => $university->getName(),
        ];
    }
}

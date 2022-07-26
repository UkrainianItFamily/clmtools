<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use Illuminate\Database\Eloquent\Collection;

final class GetMessagesByLectureIdResponse
{
    public function __construct(private Collection $messages)
    {
    }

    public function getMessages(): Collection
    {
        return $this->messages;
    }
}

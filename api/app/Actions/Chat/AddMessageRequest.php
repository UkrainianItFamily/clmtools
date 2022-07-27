<?php

declare(strict_types=1);

namespace App\Actions\Chat;

final class AddMessageRequest
{
    public function __construct(
        private int $lecture_id,
        private string $body
    )
    {
    }

    public function getLectureId(): int
    {
        return $this->lecture_id;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}

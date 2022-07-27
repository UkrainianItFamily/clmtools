<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Http\UploadedFile;

final class UploadProfileImageRequest
{
    public function __construct(private UploadedFile $image)
    {
    }

    public function getImage(): UploadedFile
    {
        return $this->image;
    }
}

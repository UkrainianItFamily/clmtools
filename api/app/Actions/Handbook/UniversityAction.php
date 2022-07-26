<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

use App\Repository\UniversityRepository;

final class UniversityAction
{
    public function __construct(private UniversityRepository $universityRepository)
    {
    }

    public function execute(UniversityRequest $request): UniversityResponse
    {
        return new UniversityResponse(
            $this->universityRepository->getById($request->getUniversityId())
        );
    }
}

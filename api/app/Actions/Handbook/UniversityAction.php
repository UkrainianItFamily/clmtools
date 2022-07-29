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
        $repository = $this->universityRepository;
        $university_id = $request->getUniversityId();
        $university = $repository->getById($university_id);

        return new UniversityResponse($university);
    }
}

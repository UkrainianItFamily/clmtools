<?php

declare(strict_types=1);

namespace App\Actions\Handbook;

use App\Repository\UniversityRepository;

final class UniversityCollectionAction
{
    public function __construct(private UniversityRepository $universityRepository)
    {
    }

    public function execute(): UniversityCollectionResponse
    {
        $repository = $this->universityRepository;
        $universities = $repository->getAll();

        return new UniversityCollectionResponse($universities);
    }
}

<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\University;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class UniversityRepository
{
    public function create(array $fields): University
    {
        return University::create($fields);
    }

    /**
     * @param int $id
     * @return University
     * @throws ModelNotFoundException
     */
    public function getById(int $id): University
    {
        return University::findOrFail($id);
    }

    public function getAll(): Collection
    {
        return University::query()->orderBy('name','asc')->get();
    }

}

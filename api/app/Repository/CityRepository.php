<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class CityRepository
{
    public function create(array $fields): City
    {
        return City::create($fields);
    }

    /**
     * @param int $id
     * @return City
     * @throws ModelNotFoundException
     */
    public function getById(int $id): City
    {
        return City::query()->findOrFail($id);
    }

    public function getAll(): Collection
    {
        return City::query()->orderBy('name','asc')->get();
    }

}

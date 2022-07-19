<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class LectureRepository
{
    public function create(array $fields): Lecture
    {
        return Lecture::create($fields);
    }

    /**
     * @param int $id
     * @return Lecture
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Lecture
    {
        return Lecture::findOrFail($id);
    }

    public function save(Lecture $lecture): Lecture
    {
        $lecture->save();

        return $lecture;
    }

    public function getLecturesByUser(int $id): Collection
    {
        return Lecture::where('user_id', $id)->select(['title', 'preview_image', 'created'])->get();
    }
}

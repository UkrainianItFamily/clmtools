<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class UserRepository
{
    public function create(array $fields): User
    {
        return User::create($fields);
    }

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function getById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    public function getStudents(): Collection
    {
        return User::where('lecturer', false)
            ->orderBy('name', 'asc')
            ->get();
    }
}

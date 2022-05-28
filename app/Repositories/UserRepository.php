<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Tracket\Core\Exceptions\ModelNotFoundException;

class UserRepository
{
    private function query(): Builder
    {
        return User::query();
    }

    public function getById(int $id): User
    {
        $user = $this->query()
            ->where('id', $id)
            ->first();

        if (!$user) {
            throw new ModelNotFoundException(User::class, 'id', $id);
        }

        return $user;
    }

    public function create(array $attributes)
    {
        $user = new User();
        $user->fill($attributes);
        $user->save();
        return $user;
    }
}

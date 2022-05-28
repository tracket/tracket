<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Tracket\Core\Exceptions\ModelNotFoundException;

class RoleRepository
{
    private function query(): Builder
    {
        return Role::query();
    }

    public function getByName(string $name): Role
    {
        $role = $this->query()
            ->where('name', $name)
            ->first();

        if (!$role) {
            throw new ModelNotFoundException(Role::class, 'name', $name);
        }

        return $role;
    }
}

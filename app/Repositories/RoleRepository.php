<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Role;

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
            throw new RoleNotFoundException($name);
        }

        return $role;
    }
}

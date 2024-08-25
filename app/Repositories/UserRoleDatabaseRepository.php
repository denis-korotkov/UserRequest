<?php

use App\Models\UserRole;
use Illuminate\Support\Collection;

class UserRoleDatabaseRepository implements UserRoleRepositoryInterface
{
    public function getAll(): Collection
    {
        return UserRole::query()->get();
    }

    public function getByRole(string $role){
        return $this->getAll()->firstWhere('role', '=', $role);
    }
}

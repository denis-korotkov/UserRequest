<?php

namespace App\Repositories;

use App\Models\UserRole;
use Illuminate\Support\Collection;

interface UserRoleRepositoryInterface
{
    public function getAll(): Collection;

    public function getByRole(string $role): UserRole;
}

<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Models\User;
use App\Models\UserRole;
use App\Repositories\UserRoleRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected readonly UserRoleRepositoryInterface $userRoleRepository,
    )
    {
    }

    public function register(array $data): void
    {
        $userDto = UserDto::fromArray($data);

        User::create([
            'name' => $userDto->getName(),
            'email' => $userDto->getEmail(),
            'password' => Hash::make($userDto->getPassword()),
            'user-role' => $this->getNewUserRoleByCurrent()->id,
        ]);
    }

    private function getNewUserRoleByCurrent(): UserRole
    {
        return $this->isUserAdmin() ?
            $this->userRoleRepository->getByRole(UserRole::ROLE_ADMIN) :
            $this->userRoleRepository->getByRole(UserRole::ROLE_USER);
    }

    public function isUserAdmin(User $user = null): bool
    {
        if (is_null($user)) $user = $this->getCurrentUser();

        return $user && $user->role->isAdmin();
    }

    public function getCurrentUser(): User|null
    {
        return auth()->user();
    }

}

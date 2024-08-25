<?php

use App\Models\User;
use App\Models\UserRole;
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

    private function isUserAdmin(): bool
    {
        return auth()->user && auth()->user->userRole->isAdmin();
    }

}

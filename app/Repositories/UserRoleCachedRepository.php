<?php

namespace App\Repositories;

use App\Models\UserRole;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserRoleCachedRepository implements UserRoleRepositoryInterface
{
    const ALL_CACHE_KEY = 'all';

    /**
     * @param int $cacheTimeSeconds
     * @param string $cachePrefix
     * @param UserRoleRepositoryInterface $userRoleRepository
     */
    public function __construct(
        protected readonly int                      $cacheTimeSeconds,
        protected readonly string                      $cachePrefix,
        protected readonly UserRoleRepositoryInterface $userRoleRepository

    )
    {

    }

    public function getAll(): Collection
    {
        return Cache::remember($this->getCacheKey(self::ALL_CACHE_KEY), $this->cacheTimeSeconds, fn() => $this->userRoleRepository->getAll());
    }

    protected function getCacheKey(string $cacheKey = ''): string
    {
        return "{$this->cachePrefix}_{$cacheKey}";
    }

    public function getByRole(string $role): UserRole
    {
        return $this->userRoleRepository->getByRole($role);
    }
}

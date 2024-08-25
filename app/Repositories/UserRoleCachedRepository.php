<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserRoleCachedRepository implements UserRoleRepositoryInterface
{
    const ALL_CACHE_KEY = 'all';

    public function __construct(
        protected readonly string $cacheTime,
        protected readonly string $cachePrefix,
        protected readonly UserRoleRepositoryInterface $userRoleRepository

    )
    {

    }

    public function getAll(): Collection
    {
        return Cache::remember($this->getCacheKey(self::ALL_CACHE_KEY), $this->cacheTime, fn() => $this->userRoleRepository->getAll());
    }

    protected function getCacheKey(string $cacheKey = ''): string
    {
        return "{$this->cachePrefix}_{$cacheKey}";
    }
}

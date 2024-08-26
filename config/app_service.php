<?php

return [
    'user_role_repository' => env('USER_ROLE_REPOSITORY', 'cached'),

    'cached_repository_cache_time' => (int)env('CACHED_REPOSITORY_CACHE_TIME', 60 * 60 * 24),
    'cached_repository_cache_prefix' => env('CACHED_REPOSITORY_CACHE_PREFIX', 'cached_repo'),
];

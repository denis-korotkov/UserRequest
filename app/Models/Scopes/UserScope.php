<?php

namespace App\Models\Scopes;

use App\Services\AuthService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserScope implements Scope
{
    public function __construct(protected readonly AuthService $authService){

    }

    /**
     * @throws Exception
     */
    public function apply(Builder $builder, Model $model)
    {
        $currentUser = $this->authService->getCurrentUser();
        if (is_null($currentUser)) throw new Exception('Unknown user');

        if (!$this->authService->isUserAdmin($currentUser)) $builder->where('user_id', '=', $currentUser->id);
    }
}

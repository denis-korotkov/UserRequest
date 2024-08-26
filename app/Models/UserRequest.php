<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $request
 * @property int $user_id
 * @property string $created_at
 */
class UserRequest extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'request',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope(app(AuthService::class)));
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}

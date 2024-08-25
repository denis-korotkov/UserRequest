<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $role
 */
class UserRole extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    protected $fillable = [
        'role',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isAdmin(){
        return $this->role == self::ROLE_ADMIN;
    }
}

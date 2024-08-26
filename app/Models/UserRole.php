<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function isAdmin(): bool
    {
        return $this->role == self::ROLE_ADMIN;
    }
}

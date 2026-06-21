<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Model
{
    protected $table    = 'admin_users';
    protected $fillable = ['username', 'password', 'name'];
    protected $hidden   = ['password'];

    public function verifyPassword(string $plain): bool
    {
        return Hash::check($plain, $this->password);
    }
}

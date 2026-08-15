<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class);
    }
}


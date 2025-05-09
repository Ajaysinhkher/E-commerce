<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{


    protected $fillable = ['name', 'slug'];
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }
}


<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $table = 'employees';

    protected $fillable = [
        'name', 'last_name', 'email', 'birthday', 'password',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_role', 'employee_id', 'role_id')->withTimestamps();
    }

    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    public function getRoles()
    {
        return $this->roles()->pluck('name')->toArray();
    }

    public function isOwner()
    {
        return $this->email === 'l.neveux@icloud.com';
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }
}

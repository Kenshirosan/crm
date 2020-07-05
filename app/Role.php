<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_role', 'employee_id', 'role_id' )->withTimestamps();
    }

    public function employee($id)
    {
        return $this->employees()->save($id);
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    public function allowTo($ability)
    {
        return $this->abilities()->save($ability);
    }
}

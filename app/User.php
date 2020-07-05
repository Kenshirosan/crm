<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'has_ordered' => 'boolean',
    ];

    protected $appends = ['addresses'];

    public function getAddressesAttribute()
    {
        return $this->addresses();
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'address_user', 'user_id', 'address_id');
    }

    public function getRouteKeyName()
    {
        return 'email';
    }

}

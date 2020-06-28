<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Hash;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Courier extends Eloquent implements AuthenticatableContract, JWTSubject
{
	use AuthenticatableTrait;
    use Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'couriers';

    protected $guard = 'courier';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * Attributes
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Relations
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }
}

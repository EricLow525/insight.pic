<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','discovery',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function byEmail($email)
    {
        return static::where('email', $email)->first();
    }
    public function loginTokens(){
        return $this->hasMany('App\LoginToken');
    }
    public function profile(){
        return $this->hasOne('App\Profile');
    }
}

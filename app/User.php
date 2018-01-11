<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'job', 'location', 'type', 'interested_in', 'password', 'subscribed', 'user_type', 'confirmed', 'confirmation_code', 'first_name', 'last_name', 'country', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if($this->user_type == 'admin')
            return true;
        return false;
    }

    public function estimates(){
        return $this->hasMany('App\Models\Estimate', 'user_id', 'id');
    }
}

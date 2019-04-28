<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use Notifiable,CanFollow,CanBeFollowed;

    public function posts()
    {
        return $this->hasMany('App\SocialPost');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function friends()
    {
        return $this->hasMany('App\Friend');
    }



}

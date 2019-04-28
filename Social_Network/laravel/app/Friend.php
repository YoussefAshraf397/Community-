<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function friend()
   {
      return $this->hasOne('App\User');
   }

   public function user()
   {
      return $this->belongsTo('App\User');
   }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_specialty extends Model
{
   protected $table = 'user_specialty';

   public function users()
      {
          return $this->belongsToMany('App\users');
      }
}

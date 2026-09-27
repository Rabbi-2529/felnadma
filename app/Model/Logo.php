<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    public static function logo(){
      $logo = Logo::first();
      return $logo;
    }
}

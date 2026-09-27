<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
  public static function facility(){
    $facilities = Facility::get();
    return $facilities;
  }
}

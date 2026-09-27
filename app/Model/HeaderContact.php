<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HeaderContact extends Model
{
  public static function contact(){
    $contact = HeaderContact::first();
    return $contact;
  }
}

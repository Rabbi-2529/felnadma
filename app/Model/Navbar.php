<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
  public static function navbar(){
    $navbar = Navbar::get();
    return $navbar;
  }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  public static function sliders(){
    $sliders = Slider::get();
    return $sliders;
  }
}

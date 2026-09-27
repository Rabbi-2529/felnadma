<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
  public static function support(){
    $support = CustomerSupport::first();
    return $support;
  }
}

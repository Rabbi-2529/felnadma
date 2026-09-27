<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
  public function prices(){
    return $this->hasMany(Price::class, 'package_id');
  }
}

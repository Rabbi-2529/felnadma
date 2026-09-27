<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  public function package(){
    return $this->belongsTo(Package::class, 'package_id');
  }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ParentLink extends Model
{
    public static function parent_links(){
      $parent_links = ParentLink::get();
      return $parent_links;
    }

    public function footerLinks(){
      return $this->hasMany(FooterLink::class, 'parent_id');
    }
}

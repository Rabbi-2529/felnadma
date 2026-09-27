<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    public function parentLink(){
      return $this->belongsTo(ParentLink::class, 'parent_id');
    }

    public static function footer_links(){
      $footer_links = FooterLink::get();
      return $footer_links;
    }
}

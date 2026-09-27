<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
 	public function page(){
      return $this->belongsTo(Navbar::class, 'nav_id');
    }
}

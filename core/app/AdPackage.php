<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdPackage extends Model
{
    public function adSize()
    {
    	return $this->belongsTo('App\AdSize', 'size', 'id');
    } 
}

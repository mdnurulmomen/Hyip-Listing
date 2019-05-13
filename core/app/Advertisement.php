<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Advertisement extends Model
{
    public function publishable()
    {
    	return $this->morphTo();
    }

    public function sizeDetails()
    {
    	return $this->belongsTo('App\AdSize', 'size', 'id');
    }

    public function packageDetails()
    {
    	return $this->belongsTo('App\AdPackage', 'package_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Companies()
    {
    	return $this->hasMany('App\Company', 'category_id', 'id');
    }
}

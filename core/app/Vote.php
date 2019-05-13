<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function Company()
    {
    	return $this->belongsTo('App\Company', 'company_id', 'id');
    }
}

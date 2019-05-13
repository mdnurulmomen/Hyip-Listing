<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawalType extends Model
{
    public function Company()
    {
    	return $this->hasMany('App\Company', 'withdrawal_type', 'id');
    }
}

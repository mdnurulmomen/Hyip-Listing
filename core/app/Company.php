<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentMediums;

class Company extends Model
{
    public function withdrawalType()
    {
        return $this->belongsTo('App\WithdrawalType', 'withdrawal_type', 'id');
    }

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }

    public function vote()
    {
        return $this->hasOne('App\Vote');
    }

    public function setCompanyFeaturesAttribute($arrayName = array())
    {
    	return $this->feature_id = json_encode($arrayName);
    }

    public function setCompanyPaymentMediumAttribute($arrayName = array())
    {
    	$this->medium_id = json_encode($arrayName);
    }

    public function getCompanyFeaturesAttribute()
    {
    	return json_decode($this->feature_id);
    }

    public function getCompanyPaymentMediumAttribute()
    {
    	return json_decode($this->medium_id);
    }

    public function features()
    {
        return Feature::find($this->company_features);
    }

    public function paymentMediums()
    {
        return PaymentMedium::find($this->company_payment_medium);
    }

    public function status()
    {
        return Status::find($this->status);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HyipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categoryId'=>'required',
            'name'=>'required',
            'totalInvestment'=>'required',
            'withdrawalType'=>'required',
            'roi'=>'required',
            'depositMin'=>'required',
            'paymentLast'=>'required',
            'status'=>'required',
            'rating'=>'required',
            'referral'=>'required',
            'description'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'categoryId.required' => 'Category is required',
            'name.required'  => 'Name is required',
            'totalInvestment.required' => 'Investment Information is required',
            'withdrawalType.required'  => 'Withdrawal Type Information is required',
            'roi.required' => 'Roi Information is required',
            'depositMin.required'  => 'Minimum Deposite is required',
            'paymentLast.required' => 'Payment Information is required',
            'status.required'  => 'Status is required',
            'rating.required' => 'Rating is required',
            'referral.required'  => 'Referral is required',
            'description.required' => 'Description is required',
        ];
    }
}

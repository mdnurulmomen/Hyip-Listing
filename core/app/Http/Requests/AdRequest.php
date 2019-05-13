<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'type'=>'required',
            'size'=>'required',
            'preview'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Ad Type is required',
            'size.required'  => 'Ad Size is required',
            'preview.required' => 'Banner is required'
        ];
    }
}

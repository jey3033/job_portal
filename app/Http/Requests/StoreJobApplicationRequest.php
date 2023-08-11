<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreJobApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'user_short_desc' => 'required',
            'birthplace' => 'required|alpha:ascii',
            'birthdate' => 'required|date',
            'id_city' => 'required|alpha:ascii',
            'tax_number' => 'required|numeric',
            'gender' => 'required',
            'religion' => 'required',
            'blood_type' => 'required',
            'marital_status' => 'required',
            'wedding_date' => 'required_unless:marital_status,Lajang',
            'race' => 'required|alpha:ascii',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'residence_phone' => 'required|numeric',
            'address' => 'required',
            'real_address' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
        ];
    }
}

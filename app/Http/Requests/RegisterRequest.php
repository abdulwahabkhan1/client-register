<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name"              =>  'required|string|max:100',
            "address1"          =>  'required',
            "address2"          =>  'required',
            "city"              =>  'required|string|max:100',
            "state"             =>  'required|string|max:100',
            "country"           =>  'required|max:100',
            "zipCode"           =>  'required|max:20',
            "phoneNo1"          =>  'required|max:20',
            "phoneNo2"          =>  'max:20',
            "user.firstName"    =>  'required|max:100',
            "user.lastName"     =>  'required|max:100',
            "user.email"        =>  'required|email|unique:App\Models\User,email|max:150',
            "user.password"     =>  'required|same:user.passwordConfirmation|max:255',
            "user.passwordConfirmation"  =>  'required|same:user.password|max:255',
            "user.phone"        =>  'required|max:20'

        ];
    }
}

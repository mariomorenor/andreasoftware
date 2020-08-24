<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'username'=>'required|min:5|max:10',
            'password'=>'required|confirmed'
        ];
    }
    public function attributes()
    {
     return [
         'password'=>'Contraseña',
         'username'=>'Usuario',
     ];   
    }
}
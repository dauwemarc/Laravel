<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return $rules = [
            'name' => 'required|string|max:255|unique:users,name,' . $this->user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
        ];
    }
}

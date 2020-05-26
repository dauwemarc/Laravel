<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id = $this->category ? ',' . $this->category->id : '';

        return $rules = [
            'name' => 'required|string|max:255|unique:categories,name' . $id,
        ];
    }
}

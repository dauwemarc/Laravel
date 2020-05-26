<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id = $this->album ? ',' . $this->album->id : '';

        return $rules = [
            'name' => 'required|string|max:255|unique:albums,name' . $id,
        ];
    }
}

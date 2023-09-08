<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdStore extends FormRequest
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
            'title' => ['required','unique:ads'],
            'description' => ['required'],
            'price' => ['required','integer'],
            'localisation' => ['required'],
            'imageFile' => ['required'],
            'imageFile.*' => ['mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048800'],

            
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'title' => 'sometimes|required|exists:titles,id',
            'first_name' => 'sometimes|required|string|alpha_num|max:30', //the field may be absent from the form(sometimes)
            'last_name' => 'sometimes|required|string|alpha_num|max:30',
        ];
    }
}

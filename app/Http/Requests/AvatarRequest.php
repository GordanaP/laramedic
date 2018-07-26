<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvatarRequest extends FormRequest
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
            'avatar_options' => [
                'required',
                Rule::in([1, 2]),
            ],
            'avatar' => [
                'required_if:avatar_options,1',
                $this->avatar_options == 1 ? 'image' : ''
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'avatar_options.required' => 'This field is required.',
            'avatar.required_if' => 'The field is required when you opt for a new avatar.',
            'avatar_options.in' => 'The selected option is invalid.',
        ];
    }
}

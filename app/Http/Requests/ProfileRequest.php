<?php

namespace App\Http\Requests;

use App\Profile;
use App\Rules\BelongsToRole;
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
        $roleIds = Profile::getProfileRolesIds($this, 'profileId');

        return [
            'title' => [
                'sometimes', 'required',
                new BelongsToRole($roleIds),
            ],
            'first_name' => 'sometimes|required|string|alpha_num|max:30', //the field may be absent from the form(sometimes)
            'last_name' => 'sometimes|required|string|alpha_num|max:30',
            'specialty' => 'sometimes|required|max:300',
            'education' => 'sometimes|required|max:300',
            'achievements' => 'sometimes|required|max:300',
            'hospital' => 'sometimes|required|max:300',
            'languages' => 'sometimes|required|max:100',
        ];
    }
}

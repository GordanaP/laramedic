<?php

namespace App\Http\Requests;

use App\Rules\AfterCurrentTime;
use App\Rules\AlphaNumSpace;
use App\Rules\NoAppointmentsOverlapping;
use App\Rules\ProfileBusinessDays;
use App\Rules\ProfileBusinessHours;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
        $rules = [
            'date' => [
                'required','date_format:Y-m-d','after_or_equal:today',
                new ProfileBusinessDays($this->profile)
            ],
            'first_name' => [
                'sometimes', 'required','string','max:50',
                new AlphaNumSpace
            ],
            'last_name' => [
                'sometimes', 'required','string','max:50',
                new AlphaNumSpace
            ],
            'birthday' => 'sometimes|required|date_format:Y-m-d|before:today|after:'.pastYears(today(), 110),
            'phone' => 'sometimes|required|digits_between:5,15',
        ];

        if ( $this->profile->isWorkingOn($this->date ))
        {
            $rules['start_at'] = [
                'required',
                'date_format:H:i',
                new ProfileBusinessHours($this->profile, $this->date),
                new NoAppointmentsOverlapping($this->profile, $this->date),
                new AfterCurrentTime($this->date),
            ];
        }

        return $rules;
    }
}
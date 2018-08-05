<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoAppointmentsOverlapping implements Rule
{
    public $profile;
    public $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($profile, $date)
    {
        $this->profile = $profile;
        $this->date = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->profile->isAvailableForAppointment($this->date, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The time is not available for booking.';
    }
}

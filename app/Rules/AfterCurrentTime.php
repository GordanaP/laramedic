<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AfterCurrentTime implements Rule
{
    public $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
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
        $current_date = now()->format('Y-m-d');
        $current_time = now()->format('H:i');

        return $this->date == $current_date ? $value > $current_time : ' ';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The time must be after current time.';
    }
}

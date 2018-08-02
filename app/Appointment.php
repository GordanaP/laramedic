<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_at'];

    /**
     * Get the profile that has the appointment.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Get the patient that has the appointment.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Create a new appointment.
     *
     * @param  array $data
     * @param  \App\Profile $profile
     * @return void
     */
    public static function createNew($data, $profile)
    {
        $patient = Patient::getPatient($data);

        $appointment = new static;

        $appointment->start_at = formatEventDate($data['date'], $data['start_at']);
        $appointment->profile()->associate($profile->id);

        $patient->appointments()->save($appointment);
    }

    /**
     * Update the appointment.
     *
     * @param  array $data
     * @return void
     */
    public static function saveChanges($data)
    {
        $appointment = static::find($data['app_id']);

        $appointment->start_at = formatEventDate($data['date'], $data['start_at']);

        $appointment->save();
    }

    /**
     * Cancel the appointment.
     *
     * @param  array $data
     * @return void
     */
    public static function cancel($data)
    {
        $appointment = static::find($data['app_id']);

        $appointment->delete();
    }
}

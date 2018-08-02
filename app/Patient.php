<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birthday'];

    /**
     * Get the appointments that belong to the profile.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the existing patient or create a new one.
     *
     * @param  array $data
     * @return \App\Patient
     */
    public static function getPatient($data)
    {
        $medicalRecord = setMedicalRecord($data['birthday'], $data['first_name'], $data['last_name']);

        $patient = static::where('record', $medicalRecord)->first();

        if(! $patient)
        {
            $patient = new static;

            $patient->first_name = $data['first_name'];
            $patient->last_name = $data['last_name'];
            $patient->birthday = $data['birthday'];
            $patient->phone = $data['phone'];
            $patient->record = $medicalRecord;

            $patient->save();
        }

        return $patient;
    }
}
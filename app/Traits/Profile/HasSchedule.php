<?php

namespace App\Traits\Profile;

trait HasSchedule
{
    /**
     * Determine if the profile is working on a particular day.
     *
     * @param  string  $day
     * @return boolean
     */
    public function isWorkingOn($day)
    {
        return $this->days->contains($day);
    }

    /**
     * Get the time for a specific profile's working day.
     *
     * @param  string $time
     * @return string
     */
    public function workingDay($time)
    {
        return $this->days->first()->work->$time;
    }

    /**
     * Determine if the profile has working shedule.
     *
     * @return boolean
     */
    public function hasSchedule()
    {
        return $this->days->count();
    }

    /**
     * Create or update profile's schedule
     *
     * @param  array $subjects
     * @return void
     */
    public function assignSchedule($data)
    {
        $schedule = $this->daysArray($data);

        if ($this->hasSchedule())
        {
            $this->days()->sync($schedule);
        }
        else
        {
            $this->days()->attach($schedule);
        }
    }

    /**
     * Create a multidimensional array
     *
     * @param  array $data
     * @return array
     */
    protected function daysArray($data)
    {
        $daysCollection = $this->daysCollection($data);

        $days = $daysCollection->mapWithKeys(function ($day) {

            return [
                $day['day_id'] => [
                    'start_at' => $day['start_at'],
                    'end_at' => $day['end_at'],
                ]
            ];
        });

        return $days->all();
    }

    /**
     * Collect day array fields
     *
     * @param  array $data
     * @return array
     */
    protected function daysCollection($data)
    {
        $daysArray = [];

        for ($i=0; $i < sizeof($data) ; $i++)
        {
            if ($data[$i]['day_id'])
            {
                array_push($daysArray, $data[$i]);
            }
        }

        return collect($daysArray);
    }
}
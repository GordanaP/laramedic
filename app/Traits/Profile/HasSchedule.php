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
}
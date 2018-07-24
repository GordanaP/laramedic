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
     * Assign schedule to the profile.
     *
     * @param  array $days
     * @param  array $starts
     * @param  array $ends
     * @return array
     */
    public function assignSchedule($days, $starts, $ends)
    {
        $schedule = $this->getMappedCollection($days, $starts, $ends);

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
     * Get a mapped collection.
     *
     * @param  array $days
     * @param  array $starts
     * @param  array $ends
     * @return array
     */
    protected function getMappedCollection($days, $starts, $ends)
    {
        $collection = collect($this->getMultiArray($days, $starts, $ends));

        $days = $collection->mapWithKeys(function ($day) {
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
     * Get multidimensional array
     *
     * @param  array $days
     * @param  array $starts
     * @param  array $ends
     * @return array
     */
    protected function getMultiArray($days, $starts, $ends)
    {
        $assocArray = [];
        $multiArray = [];

        for ($i = 0; $i < sizeof($days); $i++) {

            $assocArray[$i] = [
                'day_id' => $days[$i],
                'start_at' => $starts[$i],
                'end_at' => $ends[$i],
            ];

            array_push($multiArray, $assocArray[$i]);
        }

        return $multiArray;
    }
}
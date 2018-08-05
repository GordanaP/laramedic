<?php

/**
 * Get day time formatted.
 *
 * @return [type] [description]
 */
function dailyTime()
{
    return today()->toFormattedDateString();
}

/**
 * Determine if day time is morning
 *
 * @return bool
 */
function morningShift($start, $breakpoint)
{
    return  timeNow() >= $start && timeNow() < $breakpoint;
}

/**
 * Determine if day time is afternoon
 *
 * @return bool
 */
function afternoonShift($breakpoint, $end)
{
    return  timeNow() >= $breakpoint && timeNow() < $end;
}

/**
 * Get the hour of the day.
 *
 * @return string
 */
function timeNow($format = 'H')
{
    return now(config('app.timezone'))->format($format);
}

/**
 * Determine the day of week.
 *
 * @param  \Carbon\Carbon $day
 * @return int
 */
function weekdayId($day)
{
    return $day->dayOfWeek;
}

/**
 * Get the working hours stratified by the day time.
 *
 * @return array
 */
function workingHours($start, $breakpoint, $end)
{
    $workingHours = collect(WorkingHours::all());

    if(morningShift($start, $breakpoint))
    {
        $filteredHours = $workingHours->filter(function ($value, $key) use($start, $breakpoint, $end) {
            return $value >= $start && $value < $breakpoint;
        });
    }
    elseif (afternoonShift($breakpoint, $end))
    {
        $filteredHours = $workingHours->filter(function ($value, $key) use($start, $breakpoint, $end) {
            return $value >= $breakpoint && $value < $end;
        });
    }

    return $filteredHours->all();
}

/**
 * Get a past year
 *
 * @param  string $day
 * @param  int $years
 * @param  string $format
 * @return string
 */
function pastYears($day, $years, $format='Y-m-d')
{
    return $day->subYears($years)->format($format);
}
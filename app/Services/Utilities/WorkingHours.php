<?php

namespace App\Services\Utilities;

class WorkingHours
{
    /*
    *  A list of hours
    */
    protected static $hours = [
      1 => "09:00",
      2 => "09:30",
      3 => "10:00",
      4 => "10:30",
      5 => "11:00",
      6 => "11:30",
      7 => "12:00",
      8 => "12:30",
      9 => "13:00",
      10 => "13:30",
      11 => "14:00",
      12 => "14:30",
      13 => "15:00",
      14 => "15:30",
      15 => "16:00",
      16 => "16:30",
      17 => "17:00",
      18 => "17:30",
      19 => "18:00",
      20 => "18:30",
      21 => "19:00",
      22 => "19:30",
    ];


    /**
     * All hours
     *
     * @return array
     */
    public static function all()
    {
        return static::$hours;
    }
}
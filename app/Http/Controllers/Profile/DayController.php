<?php

namespace App\Http\Controllers\Profile;

use App\Day;
use App\Http\Controllers\Controller;
use App\Http\Requests\DayRequest;
use App\Profile;
use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function show(Day $day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit(Day $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(DayRequest $request, Profile $profile)
    {
        $days =  $request->all();

        $keys = [];

        for ($i=0; $i < sizeof($days['day']); $i++)
        {
              $a = [
                'day_id' => $days['day'][$i],
                'start_at' => $days['start'][$i],
                'end_at' => $days['end'][$i]
            ];

            if ($a['day_id']) {
                array_push($keys,$a);
            };
        }

        if ($profile->days->count())
         {
            $profile->days()->sync($keys);
         }
         else
         {
            $profile->days()->attach($keys);
         }


        return message('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function destroy(Day $day)
    {
        //
    }
}

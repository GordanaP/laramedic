<?php

namespace App\Http\Controllers\Profile;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Patient;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Profile $profile=null)
    {
        $profile = $profile ?: \Auth::user()->profile;

        if (request()->ajax())
        {
            return $profile->appointments->load('patient');
        }

        $doctors = Profile::getDoctors();

        return view('appointments.index', compact('profile', 'doctors'));
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
    public function store(AppointmentRequest $request, Profile $profile)
    {
        Appointment::createNew($request, $profile);

        return message('A new appointment has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, Profile $profile)
    {
        Appointment::saveChanges($request);

        return message('The appointment has been rescheduled.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Profile $profile)
    {
        Appointment::cancel($request);

        return message('The appointment has been deleted.');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Day;
use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        if (request()->ajax()) {
            return response([
                'profile' => $profile->load('days', 'avatar')
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $days = Day::all();

        return view('profiles.edit')->with([
            'profile' => $profile->load('days'),
            'days' => $days,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }
}

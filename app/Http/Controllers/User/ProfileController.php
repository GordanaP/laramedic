<?php

namespace App\Http\Controllers\User;

use App\Day;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Profile;
use App\Role;
use App\Title;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $profileId
     * @return \Illuminate\Http\Response
     */
    public function show($profileId)
    {
        $profile = Profile::find($profileId);

        if (request()->ajax()) {
            return response([
                'profile' => $profile->load('days', 'avatar', 'user.roles', 'user.roles.titles')
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $profileId
     * @return \Illuminate\Http\Response
     */
    public function edit($profileId)
    {
        $profile = Profile::find($profileId);

        $days = Day::all();
        $roles = Role::all();
        $titles = Title::all();

        return view('profiles.edit')->with([
            'profile' => $profile->load('days'),
            'days' => $days,
            'roles' => $roles,
            'titles' => $titles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @param  int  $profileId
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $profileId)
    {
        $profile = Profile::find($profileId);

        if(request()->ajax()) {

            $profile->user->assignProfile($request);

            $profile->user->updateUserName($request);

            return message('The profile has been saved.');
        }
    }

    public function destroy(Request $request, $profileId)
    {
        $profile = Profile::find($profileId);

        $profile->removeAttribute($request->attribute);

        return message('The field content has been deleted.');
    }
}

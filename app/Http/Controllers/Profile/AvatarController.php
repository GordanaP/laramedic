<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use App\Profile;

class AvatarController extends Controller
{
    protected $avatarPath = 'images/avatars';

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(AvatarRequest $request, Profile $profile)
    {
        if($request->ajax()) {

            $profile->assignAvatar($profile, $request, public_path($this->avatarPath));

            return message('The avatar has been saved.');
        }
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Events\Auth\AccountCreatedByAdmin;
use App\Events\Auth\AccountUpdatedByAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        if (request()->ajax()) {

            return [ 'data' => $users->load('roles', 'profile') ];
        }

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $user = User::createAccount($request);

        event(new AccountCreatedByAdmin($user, $request->password));

        return message('New account has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(request()->ajax()) {

            return response([
                'user' => $user->load('profile','roles', 'roles.titles'),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.edit')->with([
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, User $user)
    {
        if (request()->ajax())
        {
            $newEmail = $request->email;
            $newPassword = $request->password;

            if ($user->hasChangedAccessCredentials($newEmail, $newPassword))
            {
                event(new AccountUpdatedByAdmin($newEmail, $newPassword));
            }

            $user->updateAccount($request);

            return message('The account has been updated');
        }

        Auth::user()->updateAccount($request);

        return $this->updated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (request()->ajax())
        {
            $user->deleteAccount();

            return message('The account has been deleted.');
        }
    }

    /**
     * Get the response for a successfull account update.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function updated()
    {
        $response = message('Your account has been saved.');

        return back()->with($response);
    }
}

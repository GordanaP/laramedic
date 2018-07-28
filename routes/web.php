<?php

// Route::view('/test', 'test');
Route::get('/test', function(){
    $days = \App\Day::all();
    return view('test', compact('days'));
});
/*
 * Page
 */
Route::namespace('Page')->group(function(){
    Route::get('/', 'PublicController@about')->name('welcome');
    Route::get('/about', 'PublicController@about')->name('about');
    Route::get('/contact', 'PublicController@contact')->name('contact');
    Route::get('/home', 'HomeController@index')->name('home');
});

/**
 * Auth
 */
Auth::routes();

/**
 * User
 */
Route::namespace('User')->name('users.')->group(function() {
    /**
     * Account
     */
    Route::get('/my-account', 'AccountController@edit')->name('edit');
    Route::put('/my-account', 'AccountController@update')->name('update');
});


/**
 * Admin
 */
Route::prefix('admin')->name('admin.')->group(function() {

    // User
    Route::namespace('User')->group(function(){

        /**
         * Account
         */
        Route::resource('accounts', 'AccountController', [
            'parameters' => ['accounts' => 'user'],
            'only' => ['index','store', 'show', 'update', 'destroy']
        ]);

        /**
         * Profile
         */
        Route::resource('/profiles', 'ProfileController', [
            'parameters' => ['profiles' => 'profileId'],
            'only' => ['show', 'edit', 'update', 'destroy']
        ]);

        /**
         * Role
         */
        Route::delete('/revoke-role/{user}', 'RoleController@revoke')->name('roles.revoke');
        Route::resource('roles', 'RoleController');
    });

    // Profile
    Route::namespace('Profile')->group(function() {

        /**
         * Day
         */
        Route::resource('/schedule', 'DayController', [
            'parameters' => ['schedule' => 'profile'],
        ]);

        /**
         * Avatar
         */
        Route::put('admin/avatars/{profile}', 'AvatarController@update')->name('avatars.update');
    });
});


/**
 * ActivationToken
 */
Route::get('accounts/activate/{activationToken}','User\ActivationTokenController@show')->name('token.show');
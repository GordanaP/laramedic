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
Route::prefix('admin')->namespace('User')->name('admin.')->group(function(){

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
    Route::get('profiles/{profile}', 'ProfileController@show')->name('profiles.show');
    Route::get('profiles/{profile}/edit', 'ProfileController@edit')->name('profiles.edit');
    Route::resource('/profiles', 'ProfileController', [
        'parameters' => ['profiles' => 'user'],
        'only' => ['update']
    ]);

    /**
     * Role
     */
    Route::delete('/revoke-role/{user}', 'RoleController@revoke')->name('roles.revoke');
    Route::resource('roles', 'RoleController');
});

/**
 * ActivationToken
 */
Route::get('accounts/activate/{activationToken}','User\ActivationTokenController@show')->name('token.show');
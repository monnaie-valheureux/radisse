<?php

// The public-facing home page of the site.
Route::view('/', 'public.home')->name('home');


// This group defines the routes used by the public side of the site.
Route::namespace('Site')->group(function () {

    // These are the main three entry points to the inside of the site.
    // They match the three links in the main menu of the site.
    Route::view('/le-projet', 'public.project');
    Route::get('/comptoirs', 'CurrencyExchangesController@index');
    Route::get('/partenaires', 'PartnersController@index');

    // A static page telling about the ‘apéros du Val’heureux’.
    Route::view('/aperos-du-valheureux', 'public.aperos');
});


// Admin authentication routes.
Route::prefix('gestion')->namespace('Admin')->group(function () {
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
});

// This group defines the routes used by the administration area of the site.
// People need to be authenticated in order to access any of them.
Route::prefix('gestion')
     ->namespace('Admin')
     ->middleware('auth')
     ->group(function () {

    // The home page of the administration area of the site.
    Route::view('/', 'admin.home')->name('admin-home');

    // Define routes to handle partners of the local currency.
    Route::resource('partners', 'PartnersController', [
        'only' => ['index', 'show']
    ]);

    // Route to log out of the application.
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');
});

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
    Route::view('/aperos-du-valheureux', 'public.project');
});


// This group defines the routes used by the administration area of the site.
Route::prefix('gestion')->namespace('Admin')->group(function () {

    // Define routes to handle partners of the local currency.
    Route::resource('partners', 'PartnersController', [
        'only' => ['index', 'show']
    ]);

});

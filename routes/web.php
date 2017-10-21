<?php

// The public-facing home page of the site.
Route::view('/', 'public.home')->name('home');


Route::namespace('Site')->group(function () {
    Route::view('/le-projet', 'public.project');
    Route::view('/comptoirs', 'public.counters.index');
    Route::get('/partenaires', 'PartnersController@index');

    Route::view('/aperos-du-valheureux', 'public.project');
});


// This group defines the routes used by the administration area of the site.
Route::prefix('gestion')->namespace('Admin')->group(function () {

    // Define routes to handle partners of the local currency.
    Route::resource('partners', 'PartnersController', [
        'only' => ['index', 'show']
    ]);

});

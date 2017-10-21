<?php

// The public-facing home page of the site.
Route::view('/', 'public.home')->name('home');


Route::namespace('Site')->group(function () {
    Route::view('/le-projet', 'public.project');
    Route::view('/comptoirs', 'public.counters.index');
    Route::get('/partenaires', 'PartnersController@index');

    Route::view('/aperos-du-valheureux', 'public.project');
});


// If we haven’t launched yet (and are not in a local
// environment), redirect home to a teaser page.
if (
    \Carbon\Carbon::now()->lessThan(\Carbon\Carbon::parse('next Saturday 18:00')) &&
    config('app.env') !== 'local'
) {
    Route::view('/', 'public.launch-teaser');

    // Allow to see the home page via a temporary secret route.
    Route::view('/secret', 'public.home');
}


// This group defines the routes used by the administration area of the site.
Route::prefix('gestion')->namespace('Admin')->group(function () {

    // Define routes to handle partners of the local currency.
    Route::resource('partners', 'PartnersController', [
        'only' => ['index', 'show']
    ]);

});

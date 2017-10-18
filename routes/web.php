<?php

Route::view('/', 'public.home');

// If we haven’t launched yet (and are not in a local
// environment), redirect home to a teaser page.
if (
    \Carbon\Carbon::now()->lessThan(\Carbon\Carbon::parse('next Saturday 18:00')) &&
    config('app.env') !== 'local'
) {
    Route::view('/', 'public.launch-teaser');
}


// This group defines the routes used by the administration area of the site.
Route::prefix('gestion')->namespace('Admin')->group(function () {

    // Define routes to handle partners of the local currency.
    Route::resource('partners', 'PartnersController', [
        'only' => ['index', 'show']
    ]);

});

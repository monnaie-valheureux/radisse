<?php

Route::view('/', 'public.home');

// If we haven’t launched yet, add a temporary redirect to a teaser page.
if (\Carbon\Carbon::now() < \Carbon\Carbon::parse('next Saturday 18:00')) {
    Route::view('/bientot', 'public.launch-teaser');
    Route::redirect('/', '/bientot', 307);
}


// This group defines the routes used by the administration area of the site.
Route::prefix('gestion')->namespace('Admin')->group(function () {

    // Define routes to handle partners of the local currency.
    Route::resource('partners', 'PartnersController', [
        'only' => ['index', 'show']
    ]);

});

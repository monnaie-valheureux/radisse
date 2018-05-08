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

    // When retrieving partners in the admin area, we don’t want the `validated`
    // global scope to be applied by default. So, we explicitly remove it when
    // trying to retrieve a partner by its slug.
    // TODO: move this elsewhere.
    // Route::bind('partner', function ($slug) {
    //     return \App\Partner::withoutGlobalScope('validated')
    //         ->whereSlug($slug)
    //         ->first();
    // });

    // The home page of the administration area of the site.
    Route::view('/', 'admin.home')->name('admin-home');

    Route::prefix('partenaires')->group(function () {

        Route::get('/', 'PartnersController@index')
            ->name('partners.index');

        Route::get('/ajouter', 'CreatePartnerController@start')
             ->name('create-partner');

        // This route is used when no draft partner exists yet.
        Route::get('/nom/', 'CreatePartnerController@createPartnerName');
        // This route is used to go back on this step to update an
        // existing draft partner, using its slug to retrieve it.
        Route::get('/{partner}/nom/', 'CreatePartnerController@createPartnerName')
            ->name('partners.add.name');
        Route::post('/nom', 'CreatePartnerController@storePartnerName')
            ->name('partners.add.store-name');

        Route::get('/{partner}/nom-de-liste', 'CreatePartnerController@createSortName')
            ->name('partners.add.sort-name');
        Route::post('/{partner}/nom-de-liste', 'CreatePartnerController@storeSortName');

        Route::get('/{partner}/siege-social', 'CreatePartnerController@createHeadOffice')
            ->name('partners.add.head-office');
        Route::post('/{partner}/siege-social', 'CreatePartnerController@storeHeadOffice');

        Route::get(
            '/{partner}/question-lieu',
            'CreatePartnerController@askQuestionLocation'
        )->name('partners.add.question-location');
        Route::post('/{partner}/question-lieu', 'CreatePartnerController@questionLocation');

        Route::get('/{partner}/lieu', 'CreatePartnerController@createLocation')
            ->name('partners.add.location');
        Route::post('/{partner}/lieu', 'CreatePartnerController@storeLocation');

        Route::get('/{partner}/site-et-reseaux-sociaux', 'CreatePartnerController@createSiteAndSocialNetworks')
            ->name('partners.add.site-and-social-networks');
        Route::post('/{partner}/site-et-reseaux-sociaux', 'CreatePartnerController@storeSiteAndSocialNetworks');

        Route::get('/{partner}/personne-representante', 'CreatePartnerController@createRepresentatives')
            ->name('partners.add.representative');
        Route::post('/{partner}/personne-representante', 'CreatePartnerController@storeRepresentatives');

        Route::get('/{partner}/recapitulatif', 'CreatePartnerController@summary')
            ->name('partners.add.summary');

        Route::post('/{partner}/validation', 'CreatePartnerController@validatePartner');

        Route::get('/{partner}/ajoute', 'CreatePartnerController@end')
            ->name('partner.add.end');

        // Route::view('/lieu', 'admin.partners.create.location');
        // Route::view('/site-et-reseaux-sociaux', 'admin.partners.create/site-and-social-networks');
        // Route::view('/personne-representante', 'admin.partners.create/representative');
        // Route::view('/documents', 'admin.partners.create/documents');
        // Route::view('/recapitulatif', 'admin.partners.create/summary');
        // Route::view('-fini', 'admin.partners.create-end');
    });

    Route::view('partenaires/demarcher', 'admin.partners.canvass')
        ->name('canvass-partner');

    Route::get('benevoles', 'TeamMembersController@index')
        ->name('manage-team-members');
    Route::get('benevoles/{teamMember}', 'TeamMembersController@edit')
        ->name('team-members.edit');

    // Define routes to handle partners of the local currency.
    // Route::resource('partners', 'PartnersController', [
    //     'only' => ['index', 'show']
    // ]);

    // Route to log out of the application.
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');
});

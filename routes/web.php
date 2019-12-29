<?php

// The public-facing home page of the site.
Route::view('/', 'public.home')->name('home');


// This group defines the routes used by the public side of the site.
Route::namespace('Site')->group(function () {

    // These are the main three entry points to the inside of the site.
    // They match the three links in the main menu of the site.
    Route::view('/le-projet', 'public.project');
    Route::get('/comptoirs', 'CurrencyExchangesController@index');

    // Show the different possibilities to find partners.
    Route::get('/partenaires', 'PartnersController@index');
    // Show the list of cities where there are partners’ locations.
    Route::get('/partenaires/localites', 'PartnersController@indexCities');
    // Show the list of partners that have no related location.
    Route::get(
        '/partenaires-sans-adresse-precise',
        'PartnersController@indexNoLocation'
    );
    // Show the list of partners of a given city.
    Route::get('/partenaires-par-localite/{city}', 'PartnersController@indexCity');

    // Show the information of a specific partner.
    Route::get('/partenaires/{partner}', 'PartnersController@show');

    Route::get('/carte', 'MapController@index');
    Route::get('/xhr/partenaires/{partner}', 'MapController@getMapPopupContent');

    // A static page telling about the ‘apéros du Val’heureux’.
    Route::view('/aperos-du-valheureux', 'public.aperos');

    // A static page providing information about the withdrawal
    // of the first series of bills (‘Valeureux’).
    Route::view('/remplacement-anciens-billets', 'public.old-bills-withdrawal');


    // Search form on the home page.
    // TODO

    // Test page.
    Route::get('/rechercher', 'SearchController@show')
        ->name('search-page');
    // Submit a search query.
    Route::post('/rechercher', 'SearchController@search')
        ->name('search-query');


    // Newsletter.

    // Subscribe to the newsletter.
    Route::post('/newsletter', 'NewsletterController@store')
        ->name('newsletter-subscription');

    // Redirect to home page in case people try to access this POST-only URL.
    Route::get('/newsletter', function () {
        return redirect()->route('home');
    });


    // Landing page when being redirected from the old domain name.
    Route::view('/le-valeureux-est-devenu-le-valheureux', 'public.valeureux');
});


// This group defines routes for some specific uses.
Route::prefix('api')->namespace('Api')->group(function () {

    // Get a GeoJSON feature collection of the current list of locations.
    Route::get('osm/locations', 'OpenStreetMapController@locations');
});


// Admin authentication routes.
Route::prefix('gestion')->namespace('Admin')->group(function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
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

        // Make URLs directly pointing to a partner
        // redirect to this partner’s summary.
        Route::get('/{partner}', function ($partner) {
            return redirect()->route('partners.add.summary', $partner);
        })
        ->name('partner');

        Route::get('/{partner}/suppression', 'CreatePartnerController@requestDeletion')
            ->name('partner.request-deletion');
        Route::post('/{partner}/suppression', 'CreatePartnerController@sendRequestDeletion');

        // Route::view('/lieu', 'admin.partners.create.location');
        // Route::view('/site-et-reseaux-sociaux', 'admin.partners.create/site-and-social-networks');
        // Route::view('/personne-representante', 'admin.partners.create/representative');
        // Route::view('/documents', 'admin.partners.create/documents');
        // Route::view('/recapitulatif', 'admin.partners.create/summary');
        // Route::view('-fini', 'admin.partners.create-end');
    });

    Route::get('anciens-partenaires', 'FormerPartnersController@index')
        ->name('former-partners');

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
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Redirect the fools who might try to make a GET request on the logout URL.
    // We redirect them to the login form to prevent an exception to be thrown.
    // This situation has almost zero chance to happen under normal conditions.
    Route::get('/logout', function () {
        return redirect()->route('login');
    });

    // Here starts the path to a land of raw, unstyled and invalid
    // HTML, full of data and a bit of insider jokes.
    Route::get('debug/{partner}', 'DebugController@debug');
});

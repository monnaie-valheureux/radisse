<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Country Code
    |--------------------------------------------------------------------------
    |
    | This is the ISO 3166-1 alpha-2 code of the country where the currency is
    | used. This information serves several purposes. For example, it’s used
    | as a default value when providing postal addresses or phone numbers.
    */

    'country_code' => env('RADISSE_COUNTRY_CODE', 'BE'),

    /*
    |--------------------------------------------------------------------------
    | Map tile provider
    |--------------------------------------------------------------------------
    |
    | This is the URL pattern to use as a provider for OpenStreetMap tiles.
    | The official OSM site will be used as a default value.
    |
    */

    'map_tile_provider' => env(
        'RADISSE_MAP_TILE_PROVIDER',
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ),

];

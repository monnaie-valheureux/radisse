<?php

namespace App\Http\Controllers\Site;

use App\Partner;
use App\Location;
use Facades\App\Services\Geodata;
use Facades\Miclf\Geodata\GeoJSON;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class MapController extends Controller
{
    /**
     * Display the global map of partners’ locations.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // We start by getting the whole list of current partners.
        $partners = Partner::with('locations.postalAddress')->get();

        $locations = [];
        $cityNames = [];

        // We’ll then loop on all the locations associated with these partners.
        foreach ($partners as $partner) {
            foreach ($partner->locations as $location) {

                // Skip the location if it has no defined coordinates.
                if (!$location->hasGeoCoordinates()) {
                    continue;
                }

                $cityNames[] = $location->postalAddress->city;

                $locations[] = [
                    'name' => $location->name,
                    'latitude' => $location->postalAddress->latitude,
                    'longitude' => $location->postalAddress->longitude,
                    'is_currency_exchange' => $location->hasCurrencyExchange(),
                    'partner_slug' => $partner->slug,
                ];
            }
        }

        // We’ll use the list of city names to retrieve the
        // municipalities they belong to. Then, we’ll get
        // the GeoJSON features for these municipalities.

        $cityNames = array_unique($cityNames);

        $municipalityCodes = array_unique(array_map(function ($city) {
            return Geodata::getCommuneNISCodeForCity($city);
        }, $cityNames));

        // We’ll cache the GeoJSON of the municipalities for a little
        // while, to avoid constantly recalculating the same things.
        $municipalities = Cache::remember(
            'municipalitiesGeoJSON',
            now()->addMinutes(10),
            function() use ($municipalityCodes) {
                return GeoJSON::getByNISCode($municipalityCodes);
            }
        );

        return view('public.partners.map', compact('locations', 'municipalities'));
    }

    /**
     * Get the content of an OSM map popup for a given partner.
     *
     * @param  \App\Partner  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getMapPopupContent(Partner $partner)
    {
        return
            '<div class="osm-map-popup">
                <a href="/partenaires/'.$partner->slug.'">Voir sa page</a>
            </div>';
    }
}

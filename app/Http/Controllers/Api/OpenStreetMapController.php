<?php

namespace App\Http\Controllers\Api;

use App\Partner;
use GeoJson\Geometry\Point;
use GeoJson\Feature\Feature;
use App\Http\Controllers\Controller;
use GeoJson\Feature\FeatureCollection;

class OpenStreetMapController extends Controller
{
    /**
     * Return the current list of locations as a GeoJSON feature collection.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function locations()
    {
        $partners = Partner::with([
            'websites',
            'locations.postalAddress',
            'locations.currencyExchange',
        ])
        ->get();

        $features = [];

        // We’ll then loop on all the locations associated with the partners.
        foreach ($partners as $partner) {
            foreach ($partner->locations as $location) {

                // Skip the location if it has no defined coordinates, because
                // it obviously could not be put into a GeoJSON object.
                if (!$location->hasGeoCoordinates()) {
                    continue;
                }

                // Define the coordinates of the current location.
                // Longitude comes first in GeoJSON.
                // See https://macwright.org/lonlat/
                $coordinates = new Point([
                    $location->postalAddress->longitude,
                    $location->postalAddress->latitude
                ]);

                $properties = ['name' => $location->name];

                // Do we have a ‘sorting name’ (on the partner) that is
                // different than the regular name (of the location)?
                if (
                    $partner->name_sort &&
                    $partner->name_sort !== $location->name
                ) {
                    $properties['sorting_name'] = $partner->name_sort;
                }

                // House number of the location’s postal address.
                if ($location->postalAddress->streetNumber) {
                    $properties['addr:housenumber'] =
                        $location->postalAddress->streetNumber;
                }
                // Street name of the location’s postal address.
                if ($location->postalAddress->street) {
                    $properties['addr:street'] = $location->postalAddress->street;
                }

                // Website related to the location.
                if ($partner->websites->isNotEmpty()) {
                    $properties['website'] = $partner->websites->first()->url;
                }

                // If you can pay with the notes of the local currency,
                // then it means that you can obviously pay with cash.
                $properties['payment:cash'] = 'yes';


                // Finally, add the properties related to the local currency.

                $properties['payment:cash:XLT-VALH'] = 'yes';
                $properties['currency:XLT'] = 'VALH';

                // Does this location host a currency exchange?
                if ($location->hasCurrencyExchange()) {
                    $properties['change:XLT-VALH'] = 'yes';
                }

                // Add the finalized GeoJSON feature to the collection.
                $features[] = new Feature($coordinates, $properties);
            }
        }

        // Send a GeoJSON feature collection as the response to the
        // request. Laravel will automatically convert it to JSON
        // and set the relevant HTTP headers accordingly.
        return response(new FeatureCollection($features));
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Partner;
use App\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Handle the pages dedicated to partners of the currency.
 */
class PartnersController extends Controller
{
    /**
     * Display the list of cities where there are partners’ locations.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function indexCities()
    {
        // We’ll get a collection with alphabetically sorted
        // city names as keys and the total number of
        // locations in these cities as values.

        // Start by sorting city names alphabetically.
        $cities = Location::with('partner')
            ->orderBy('city_cache')
            // Make the SQL query.
            ->get()
            // At this point, we have a flat collection of Location objects.
            // We now reject potential ‘orphan’ locations that are not
            // related to any partner.
            ->reject(function ($location) {
                return is_null($location->partner);
            })
            // Then we group locations by city name.
            ->groupBy('city_cache')
            // Finally, we replace each city’s subcollection
            // of Locations by the amount of locations in
            // these different subcollections.
            ->map(function ($locationGroup) {
                return count($locationGroup);
            });

        // We will now group cities by ranges of letters
        // in order to make them a bit easier to find.
        $letterRanges = [
            'A-C' => ['A', 'B', 'C'],
            'D-F' => ['D', 'E', 'F'],
            'G-K' => ['G', 'H', 'I', 'J', 'K'],
            'L-P' => ['L', 'M', 'N', 'O', 'P'],
            'Q-T' => ['Q', 'R', 'S', 'T'],
            'U-Z' => ['U', 'V', 'W', 'X', 'Y', 'Z'],
        ];

        $citiesByLetterRanges = $cities->groupBy(
            function ($locationCount, $city) use ($letterRanges) {

                // Get the first letter of the city name.
                $firstLetter = Str::substr($city, 0, 1);

                // Find in which letter range the city goes.
                foreach ($letterRanges as $range => $letters) {
                    if (in_array($firstLetter, $letters)) {
                        return $range;
                    }
                }
            },
            $preserveKeys = true
        );

        // Get the collection of partners that have no related location.
        $partnersWithoutLocationCount = Partner::doesntHave('locations')->count();

        // Count the total number of cities we got.
        $cityCount = count($cities);

        return view('public.partners.index-cities', compact(
            'cityCount', 'citiesByLetterRanges', 'partnersWithoutLocationCount'
        ));
    }

    /**
     * Display the list of partners of a given city.
     *
     * @param  string  $city  The name of the city
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function indexCity($city)
    {
        // We start with locations, not partners, because
        // they are the ones who have a public address.
        $partners = Location::with('partner.locations.currencyExchange')
            ->where('city_cache', $city)
            ->get()
            // Once we got the proper locations, we
            // replace each one by its partner.
            ->map(function ($location) {
                return $location->partner;
            })
            // Remove null values. These probably come from
            // locations belonging to former partners…
            ->filter()
            // Remove duplicates (partners that have multiple locations would
            // otherwise appear as many times as the number of locations).
            ->unique()
            // Finally, we sort partners alphabetically.
            ->sortBy(function ($partner) {
                // Converting the names to lowercase ASCII before sorting them
                // prevents the dumb sorting algorithm to produce bad results.
                return Str::ascii(Str::lower($partner->name_sort));
            });

        // If the city has many partners, we will group them by ranges
        // of letters instead of just displaying a raw list.
        if (count($partners) > 50) {

            $partnersByInitials = $partners->groupBy(function ($partner) {

                    $firstLetter = Str::substr($partner->name_sort, 0, 1);

                    // Converting to ASCII allows to put letters
                    // like ‘A’ and ‘À’ in the same group.
                    return Str::ascii($firstLetter);
                }
            );

            return view(
                'public.partners.index-city-with-many-partners',
                compact('city', 'partnersByInitials')
            );
        }

        return view('public.partners.index-city', compact('city', 'partners'));
    }

    /**
     * Display the list of partners that have no related location.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function indexNoLocation()
    {
        $partners = Partner::doesntHave('locations')
            ->get()
            ->sortBy(function ($partner) {
                // Converting the names to lowercase ASCII before sorting them
                // prevents the dumb sorting algorithm to produce bad results.
                return Str::ascii(Str::lower($partner->name_sort));
            });

        return view('public.partners.index-no-location', compact('partners'));
    }

    /**
     * Display the details of a given partner.
     *
     * @param  \App\Partner  $partner
     *
     * @return V\Illuminate\Contracts\View\View
     */
    public function show(Partner $partner)
    {
        return view('public.partners.show', compact('partner'));
    }
}

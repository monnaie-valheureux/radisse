<?php

namespace App\Http\Controllers\Site;

use App\CurrencyExchange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Handle the pages dedicated to currency exchange counters.
 */
class CurrencyExchangesController extends Controller
{
    /**
     * Display the current list of currency exchanges.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $currencyExchanges = CurrencyExchange::with(
            'location.postalAddress',
            'location.partner'
        )
        ->get();

        // Sort the currency exchanges by city.
        $currencyExchanges = $currencyExchanges->sortBy(function ($currencyExchange) {
            return $currencyExchange->location->postalAddress->city;
        });
        // Then, once they’re sorted, group them by city.
        $cities = $currencyExchanges->groupBy(function ($currencyExchange) {
            return $currencyExchange->location->postalAddress->city;
        })
        // After that, for each city, sort currency exchanges alphabetically.
        ->map(function ($currencyExchanges) {

            return $currencyExchanges->sortBy(function ($currencyExchange) {
                return $currencyExchange->location->partner->name_sort;
            })
            // Finally, replace each CurrencyExchange model by its PostalAddress.
            ->map(function ($currencyExchange) {

                $address = $currencyExchange->location->postalAddress;
                $address->recipient = $currencyExchange->location->name;

                // To make linking to the partner page easier, we add a public
                // property with the partner’s slug in a quick and dirty way.
                $address->partnerSlug = $currencyExchange->location->partner->slug;

                return $address;
            });
        });

        return view('public.currency-exchanges.index', compact('addresses'));
    }
}

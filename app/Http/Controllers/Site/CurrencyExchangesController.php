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
        ->get()
        // Sort currency exchanges by the ‘sort name’ of their partner.
        ->sortBy(function ($currencyExchange) {
            return $currencyExchange->location->partner->name_sort;
        });

        // Get the postal addresses of the currency exchanges.
        $addresses = $currencyExchanges->map(function ($currencyExchange) {
            $address = $currencyExchange->location->postalAddress;
            // Use the partner’s ‘sort name’ in the address.
            $address->recipient = $currencyExchange->location->partner->name_sort;

            return $address;
        });

        return view('public.currency-exchanges.index', compact('addresses'));
    }
}

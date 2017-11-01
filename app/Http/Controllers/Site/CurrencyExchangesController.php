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
        $currencyExchanges = CurrencyExchange::with('location.postalAddress')
            ->get();

        return view('public.currency-exchanges.index', compact('currencyExchanges'));
    }
}

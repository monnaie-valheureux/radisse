<?php

namespace App\Http\Controllers\Site;

use App\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Handle the pages dedicated to partners of the currency.
 */
class PartnersController extends Controller
{
    /**
     * Display the current list of partners.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $partners = Partner::with('locations.postalAddress')
            ->orderBy('name_sort')->get();

        // Group partners by the initial letter of their sort name.
        $initials = $partners->groupBy(function ($partner) {
            $firstLetter = Str::substr($partner->name_sort, 0, 1);
            // Converting to ASCII allows to put letters
            // like ‘A’ and ‘À’ in the same group.
            return Str::ascii($firstLetter);
        })
        // Then, for each letter, sort partners alphabetically.
        ->map(function ($partners) {
            return $partners->sortBy(function ($partner) {
                // Converting the names to lowercase ASCII before sorting them
                // prevents the dumb sorting algorithm to produce bad results.
                return Str::ascii(Str::lower($partner->name_sort));
            });
        });

        // The list of partners is now ready for the view.
        return view('public.partners.index', compact('initials'));
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

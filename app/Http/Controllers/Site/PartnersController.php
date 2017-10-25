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
        $partners = Partner::orderBy('name_sort')->get();

        // Group partners by the initial letter of their sort name.
        $initials = $partners->groupBy(function ($partner) {
            $firstLetter = Str::substr($partner->name_sort, 0, 1);
            return Str::ascii($firstLetter);
        })
        // Then, for each letter, sort partners alphabetically.
        ->map(function ($partners) {
            return $partners->sortBy(function ($partner) {
                return Str::ascii(Str::lower($partner->name_sort));
            });
        });

        // The list of partners is now ready for the view.
        return view('public.partners.index', compact('initials'));
    }
}

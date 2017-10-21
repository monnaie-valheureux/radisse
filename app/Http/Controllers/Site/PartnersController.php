<?php

namespace App\Http\Controllers\Site;

use App\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnersController extends Controller
{
    /**
     * Display a list of partners.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Exclude partners who left the network.
        // TODO: handle this via a default query scope?
        $partners = Partner::whereNull('left_on')
            ->orderBy('name_sort')
            ->get();

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

        return view('public.partners.index', compact('initials'));
    }
}

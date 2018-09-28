<?php

namespace App\Http\Controllers\Admin;

use App\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Handles actions targeting the partners of the currency.
 */
class PartnersController extends Controller
{
    /**
     * Display a list of partners.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Retrieve the team of the authenticated person.
        $team = auth()->user()->team;

        // Take only the partners that are active.
        $partners = Partner::active()->with(
            'team',
            'locations.postalAddress',
            'locations.currencyExchange'
        )
        ->orderBy('name_sort')->get();

        // We separate the list of partners in two categories: those that belong
        // to the team of the authenticated person, and those that don’t.
        list($teamPartners, $otherPartners) = $partners->partition(
            function ($partner) use ($team) {
                return $partner->team_id === $team->id;
            }
        );

        // Group partners by the initial letter of their name.
        $teamPartners = $teamPartners->groupBy(function ($partner) {
            // Use the sort name if possible, or the ‘normal’ name otherwise.
            $name = $partner->name_sort ?? $partner->name;
            $firstLetter = Str::substr($name, 0, 1);

            // Converting to ASCII allows to put letters
            // like ‘A’ and ‘À’ in the same group.
            return Str::ascii($firstLetter);
        })
        // Then, for each letter, sort partners alphabetically.
        ->map(function ($partners) {
           return $partners->sortBy(function ($partner) {
                // Use the sort name if possible, or the ‘normal’ name otherwise.
                $name = $partner->name_sort ?? $partner->name;

                // Converting the names to lowercase ASCII before sorting them
                // prevents the dumb sorting algorithm to produce bad results.
                return Str::ascii(Str::lower($name));
           });
        });

        $teamPartnersCount = count($teamPartners->collapse());
        $teamPartnersInitials = $teamPartners->keys();


        // Duplicated code for the other list. I did
        // not found any better way to do that yet.

        // Group partners by the initial letter of their sort name.
        $otherPartners = $otherPartners->groupBy(function ($partner) {
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

        $otherPartnersCount = count($otherPartners->collapse());
        $otherPartnersInitials = $otherPartners->keys();


        // Get the list of partners that the authenticated team
        // member created and that are not validated yet.
        $wipPartners = Partner::where('creator_team_member_id', auth()->id())
            ->whereNull('validated_at')
            ->get()
            ->sortBy(function ($partner) {
                // Use the sort name if possible, or the ‘normal’ name otherwise.
                $name = $partner->name_sort ?? $partner->name;

                // Converting the names to lowercase ASCII before sorting them
                // prevents the dumb sorting algorithm to produce bad results.
                return Str::ascii(Str::lower($name));
           });


        // The list of partners is now ready for the view.
        return view('admin.partners.index', compact(
            'partners',
            'wipPartners',
            'teamPartners', 'teamPartnersCount', 'teamPartnersInitials',
            'otherPartners', 'otherPartnersCount', 'otherPartnersInitials'
        ));
    }
}

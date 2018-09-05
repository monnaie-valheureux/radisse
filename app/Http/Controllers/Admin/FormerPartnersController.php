<?php

namespace App\Http\Controllers\Admin;

use App\Partner;
use App\Http\Controllers\Controller;

class FormerPartnersController extends Controller
{
    /**
     * Display the list of former partners.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $formerPartners = Partner::former()
            ->with('team')
            ->orderByDesc('left_on')
            ->get();

        $formerPartnersCount = count($formerPartners);

        $formerPartners = $formerPartners->groupBy(function ($partner) {
            $month = $partner->left_on->format('F');
            $year = $partner->left_on->format('Y');

            return ucfirst(__('time.'.$month)).' '.$year;
        });

        return view('admin.former-partners', compact(
            'formerPartners',
            'formerPartnersCount'
        ));
    }
}

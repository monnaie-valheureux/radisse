<?php

namespace App\Http\Controllers\Admin;

use App\Partner;
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
        $partners = Partner::all();

        return view('admin.partners.index', compact('partners'));
    }
}

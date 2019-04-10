<?php

namespace App\Http\Controllers\Site;

use App\Partner;
use App\Location;
use Facades\App\Services\Geodata;
use Facades\Miclf\Geodata\GeoJSON;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class MapController extends Controller
{
    /**
     * Display the global map of partners’ locations.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('public.partners.map');
    }

    /**
     * Get the content of an OSM map popup for a given partner.
     *
     * @param  \App\Partner  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getMapPopupContent(Partner $partner)
    {
        return
            '<div class="osm-map-popup">
                <a href="/partenaires/'.$partner->slug.'">Voir sa page</a>
            </div>';
    }
}

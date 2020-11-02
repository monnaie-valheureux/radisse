<?php

namespace App\Services;

use App\Partner;
use Facades\App\Services\Geodata;
use Facades\Miclf\Geodata\GeoJSON;
use Illuminate\Support\Facades\File;

class GeneralMap
{
    /**
     * The path to the generated JavaScript file
     * that stores the data used by the map.
     *
     * @var string
     */
    protected $dataScriptPath;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        // Set the path of the data file. This is a generated JavaScript file
        // that stores the data to be used by the general map of partners.
        $this->dataScriptPath = storage_path('app/generated/general-map-data.js');
    }

    /**
     * Generate the JS data file.
     *
     * @return string  The contents of the generated file.
     */
    protected function makeDataScript()
    {
        $locations = [];
        $cityNames = [];

        // We’ll then loop on all the locations associated with the partners.
        foreach ($this->getPartners() as $partner) {
            foreach ($partner->locations as $location) {

                // Skip the location if it has no defined coordinates,
                // because it obviously could not be placed on a map.
                if (!$location->hasGeoCoordinates()) {
                    continue;
                }

                $cityNames[] = $location->postalAddress->city;

                // Get some data from each location.
                $locations[] = [
                    'name' => $location->name,
                    'latitude' => $location->postalAddress->latitude,
                    'longitude' => $location->postalAddress->longitude,
                    'is_currency_exchange' => $location->hasCurrencyExchange(),
                    'partner_slug' => $partner->slug,
                ];
            }
        }

        // We’ll use the list of city names to retrieve the
        // municipalities they belong to. Then, we’ll get
        // the GeoJSON features for these municipalities.
        $municipalities = $this->getMunicipalitiesFromCityNames($cityNames);

        // Prepare the contents of the data file.
        $mapData = compact('locations', 'municipalities');
        $fileContents = 'window.generalMapData = '.json_encode($mapData).';';

        // Store the generated contents.
        File::put($this->dataScriptPath, $fileContents);

        // Return the generated contents.
        return $fileContents;
    }

    /**
     * Get the list of partners to consider for the map.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPartners()
    {
        return Partner::with([
            'locations.postalAddress',
            'locations.currencyExchange',
        ])
        ->get();
    }

    /**
     * Return an array of GeoJSON data from a list of city names.
     *
     * @param  array  $cityNames
     *
     * @return array
     */
    protected function getMunicipalitiesFromCityNames(array $cityNames)
    {
        $cityNames = array_unique($cityNames);

        // We first get the list of NIS codes corresponding to
        // the municipalities “owning” the given cities.
        $municipalityCodes = array_unique(array_map(function ($city) {
            return Geodata::getCommuneNISCodeForCity($city);
        }, $cityNames));

        // Remove potential null values.
        $municipalityCodes = array_filter($municipalityCodes);

        // Return the list of GeoJSON features for the given municipalities.
        return GeoJSON::getByNISCode($municipalityCodes);
    }

    /**
     * Delete the JS data file.
     *
     * @return void
     */
    protected function invalidateDataScript()
    {
        if (File::exists($this->dataScriptPath)) {
            File::delete($this->dataScriptPath);
        }
    }

    /**
     * Get the contents of the data file.
     *
     * @return string
     */
    public function getDataScript()
    {
        if (!File::exists($this->dataScriptPath)) {
            $this->makeDataScript();
        }

        return File::get($this->dataScriptPath);
    }

    /**
     * Invalidate and regenerate the JS data file.
     *
     * @return string  The contents of the regenerated file.
     */
    public function refreshDataScript()
    {
        $this->invalidateDataScript();

        return $this->getDataScript();
    }
}

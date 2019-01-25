<?php

namespace App\Console\Commands;

use App\Location;
use App\PostalAddress;
use Illuminate\Console\Command;

class CacheLocationCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache-location-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determine and cache the city of each location';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Start by clearing the cache.
        $this->line('Clearing city cache...');
        $this->callSilent('app:clear-location-cities');

        $this->line('Rebuilding city cache...');

        // We will loop on all locations and, for each one, if it has an
        // address, then we will use it to update the Location’s city.
        $locations = Location::with('postalAddress')->get();
        $total = count($locations);

        foreach ($locations as $location) {
            if ($address = $location->postalAddress) {
                $location->city_cache = $address->city;
                $location->save();
            }
        }

        $this->info("🎉 City cache built for <comment>{$total}</comment> locations!");
    }
}

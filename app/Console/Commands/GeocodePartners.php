<?php

namespace App\Console\Commands;

use Exception;
use App\Partner;
use App\Services\Geocoder;
use Illuminate\Console\Command;
use App\Exceptions\NonGeolocatable;

class GeocodePartners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:geocode-partners
                            {--a|show-all : Show all partners with locations, even skipped ones}
                            {--m|generate-maps : Generate a map for each location that doesn’t have one}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Try to geocode the address of each partner’s locations';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startTime = microtime(true);

        $geocoder = new Geocoder;

        // Get all the active partners and their locations.
        $partners = Partner::with('locations.postalAddress')
            ->orderBy('id')
            ->get();

        // Loop on all the partners.
        foreach ($partners as $partner) {

            // We’ll skip the partner if it has no
            // location with a defined address.
            if ($this->hasNoLocationWithAnAddress($partner)) {

                if ($this->option('show-all')) {
                    $this->line(sprintf(
                        "%4d - %s: skipped \033[2m(no address)\033[0m",
                        $partner->id, $partner->name
                    ));
                }

                continue;
            }

            // Display which partner we’re currently processing.
            $this->line(sprintf('%4d - %s', $partner->id, $partner->name));

            // Loop on all the locations of the current partner.
            foreach ($partner->locations as $location) {

                $hasGeocodedLocation = false;
                $hasGeneratedMap = false;

                $address = $location->postalAddress;
                $singleLineAddress = str_replace("\n", ', ', $address);

                $lineOutput = "     - <info>{$singleLineAddress}</info>: ";

                // Skip the address if it has coordinates already.
                if ($address->hasGeoCoordinates()) {

                    $lineOutput .=
                        "skipped geocoding \033[2m(existing coordinates)\033[0m";

                } elseif ($address->isGeolocatable === false) {

                    // Also skip it if it has been explicilty marked as invalid.
                    $lineOutput .=
                        "<fg=red>skipped geocoding, flagged as not geolocatable</>".
                        " (contact detail ID: {$address->id})";

                } else {

                    // We try to geocode the postal address
                    // and then save its coordinates.
                    try {
                        $coords = $geocoder->getCoordinates($address->toString());

                        $address->latitude = $coords->latitude;
                        $address->longitude = $coords->longitude;
                        $address->isGeolocatable = true;

                        $address->save();

                        $lineOutput .=
                            "<comment>{$coords->latitude}, ".
                            "{$coords->longitude}</comment> 🌍";

                        $hasGeocodedLocation = true;

                    } catch (Exception $e) {
                        $address->isGeolocatable = false;
                        $address->save();

                        $lineOutput .= "<fg=red>no match found</>";
                    }
                }

                // If we asked to generate maps and the current location
                // does not have one, let’s create one.
                if ($this->option('generate-maps') && !$location->hasMedia('maps')) {
                    try {
                        $location->generateMap();

                        sleep(1);
                        $lineOutput .= " 🗺";

                    } catch (NonGeolocatable $e) {
                        $lineOutput .=
                            " <fg=red>skipped map generation, ".
                            "flagged as not geolocatable</>";
                    }

                    $hasGeneratedMap = true;
                }

                if (
                    $hasGeocodedLocation ||
                    $hasGeneratedMap ||
                    $this->option('show-all')
                ) {
                    $this->line($lineOutput);
                }
            }
        }

        $elapsedTime = round(microtime(true) - $startTime, 2);

        $this->line(
            "\n🎉 Done! \033[2m({$elapsedTime} sec)\033[0m"
        );
    }

    /**
     * Check if a given partner has only locations without any defined address.
     *
     * @param  \App\Partner  $partner
     *
     * @return bool
     */
    protected function hasNoLocationWithAnAddress(Partner $partner)
    {
        return (count($partner->locations->filter->postalAddress) == 0);
    }
}

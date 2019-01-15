<?php

namespace App\Console\Commands;

use App\Partner;
use App\Services\Geocoder;
use Illuminate\Console\Command;

class GeocodePartners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:geocode-partners';

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

        foreach ($partners as $partner) {

            $hasNoLocationWithAddress =
                count($partner->locations->filter->postalAddress) == 0;

            if ($hasNoLocationWithAddress) {

                $this->line(sprintf(
                    "%4d - %s: skipped \033[2m(no address)\033[0m",
                    $partner->id, $partner->name
                ));

                continue;
            }


            $this->line(sprintf('%4d - %s', $partner->id, $partner->name));

            foreach ($partner->locations as $location) {

                $address = $location->postalAddress;
                $singleLineAddress = str_replace("\n", ', ', $address);

                $lineOutput = "     - <info>{$singleLineAddress}</info>: ";

                // Skip the address if it has coordinates already.
                if ($address->hasGeoCoordinates()) {
                    $lineOutput .=
                        "skipped \033[2m(existing coordinates)\033[0m";

                } elseif ($address->isGeolocatable === false) {
                    // Also skip it if it has been explicilty marked as invalid.
                    $lineOutput .=
                        "<fg=red>skipped, flagged as not geolocatable</>".
                        " (contact detail ID: {$address->id})";

                } else {

                    try {
                        $coords = $geocoder->getCoordinates($address->toString());

                        $address->latitude = $coords->latitude;
                        $address->longitude = $coords->longitude;
                        $address->isGeolocatable = true;

                        $address->save();

                        $lineOutput =
                            "  🌍 - <info>{$singleLineAddress}</info>: ".
                            "<comment>{$coords->latitude}, ".
                            "{$coords->longitude}</comment>";

                    } catch (\Exception $e) {
                        $address->isGeolocatable = false;
                        $address->save();

                        $lineOutput .= "<fg=red>no match found</>";
                    }
                }

                $this->line($lineOutput);
            }
        }

        $elapsedTime = round(microtime(true) - $startTime, 2);

        $this->line(
            "\n🎉 Done! \033[2m({$elapsedTime} sec)\033[0m"
        );
    }
}

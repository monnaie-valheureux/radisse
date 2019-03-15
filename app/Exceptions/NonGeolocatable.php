<?php

namespace App\Exceptions;

use Exception;
use App\Location;
use App\PostalAddress;

class NonGeolocatable extends Exception
{
    public static function geocodingProvidersFoundNothing(string $address): self
    {
        return new self("Geocoding providers were not able to geocode address [{$address}].");
    }

    public static function markedExplicitly(PostalAddress $address): self
    {
        return new self("Address [{$address->toString()}] could not be geocoded because it is explicitly marked as non-geolocatable.");
    }

    public static function locationHasNoAddress(Location $location): self
    {
        return new self("Location [{$location->name}] (ID {$location->id}) has no defined postal address.");
    }
}

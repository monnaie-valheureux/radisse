<?php

namespace App\Services;

use Geocoder\ProviderAggregator;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Provider\SPW\SPW as SPWProvider;
use Http\Adapter\Guzzle6\Client as GuzzleClient;
use Geocoder\Provider\bpost\bpost as bpostProvider;
use Geocoder\Provider\Chain\Chain as ProviderChain;

class Geocoder
{
    /**
     * @var \Geocoder\ProviderAggregator
     */
    protected $geocoder;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $guzzle = new GuzzleClient;

        $this->geocoder = new ProviderAggregator();

        // We register different providers. If one does not
        // find anything, the next ones will be used till
        // we get a result or reach the end of the chain.
        $this->geocoder->registerProvider(new ProviderChain([
            new bpostProvider($guzzle),
            new SPWProvider($guzzle),
        ]));
    }

    /**
     * Geocode a given address.
     *
     * @param  string  $address
     *
     * @return \Geocoder\Model\Address
     */
    public function geocode($address)
    {
        $result = $this->geocoder->geocodeQuery(GeocodeQuery::create($address));

        // Throw an exception in case none of the
        // registered providers found anything.
        if ($result->isEmpty()) {
            throw new \Exception("Could not geolocate [$address]");
        }

        // Return the first match that we got.
        return $result->first();
    }

    /**
     * Get the latitude and longitude for a given address.
     *
     * @param  string  $address
     *
     * @return stdClass  An object with `latitude` and `longitude` properties.
     */
    public function getCoordinates($address)
    {
        $result = $this->geocode($address)->getCoordinates();

        $coords = new \stdClass;
        $coords->latitude = $result->getLatitude();
        $coords->longitude = $result->getLongitude();

        return $coords;
    }
}

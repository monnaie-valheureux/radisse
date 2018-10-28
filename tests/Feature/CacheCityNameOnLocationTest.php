<?php

namespace Tests\Feature;

use App\Location;
use Tests\TestCase;
use App\PostalAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CacheCityNameOnLocationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_fills_the_city_column_on_the_location_when_adding_a_postal_address()
    {
        // Create a location.
        $location = factory(Location::class)->create();

        // Ensure its city cache attribute is empty.
        $this->assertNull($location->city_cache);

        $address = PostalAddress::fromArray([
            'recipient' => 'Boucherie Sanzot',
            'street' => 'rue du Château',
            'street_number' => '1',
            'postal_code' => '1234',
            'city' => 'Moulinsart',
        ]);

        $location->postalAddress()->save($address);

        // Reload the location from the database,
        // to ensure we have the correct data.
        $location->refresh();

        // Ensure the city name has been updated.
        $this->assertSame('Moulinsart', $location->city_cache);

        // Now, we’ll test that updating the existing PostalAddress model
        // itself properly triggers an update on the related Location.
        $address->city = 'Las Dopicos';
        $address->save();

        // Ensure the city name has been updated.
        $location->refresh();
        $this->assertSame('Las Dopicos', $location->city_cache);
    }
}

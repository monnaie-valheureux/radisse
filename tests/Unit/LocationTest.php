<?php

namespace Tests\Unit\Admin;

use App\Partner;
use App\Location;
use Tests\TestCase;
use App\CurrencyExchange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_retrieve_its_partner()
    {
        $partner = factory(Partner::class)->create();

        $location = factory(Location::class)->create([
            'partner_id' => $partner->id,
        ]);

        $retrievedPartner = $location->partner;

        $this->assertSame($partner->id, $retrievedPartner->id);
    }

    /** @test */
    function can_retrieve_its_currency_exchange()
    {
        // Create a location.
        $location = factory(Location::class)->create();

        // Then, create a currency exchange for this location.
        $currencyExchange = factory(CurrencyExchange::class)->create([
            'location_id' => $location->id,
        ]);

        // Retrieve the currency exchange.
        $retrievedCurrencyExchange = $location->currencyExchange;

        // Check that we got the correct object.
        $this->assertSame($currencyExchange->id, $retrievedCurrencyExchange->id);
    }

    /** @test */
    function reading_the_city_attribute_gets_the_values_of_the_city_cache_column()
    {
        // Create a location.
        $location = factory(Location::class)->create([
            'city_cache' => 'Moulinsart'
        ]);

        // Test the Eloquent accessor.
        $this->assertSame('Moulinsart', $location->city);
    }
}

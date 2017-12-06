<?php

namespace Tests\Unit\Admin;

use App\Location;
use Tests\TestCase;
use App\CurrencyExchange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CurrencyExchangeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_retrieve_its_location()
    {
        $location = factory(Location::class)->create();

        $currencyExchange = factory(CurrencyExchange::class)->create([
            'location_id' => $location->id,
        ]);

        $retrievedLocation = $currencyExchange->location;

        $this->assertSame($location->id, $retrievedLocation->id);
    }
}

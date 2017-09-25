<?php

namespace Tests\Unit\Admin;

use App\Partner;
use App\Location;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
}

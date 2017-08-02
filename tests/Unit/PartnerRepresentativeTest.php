<?php

namespace Tests\Unit\Admin;

use App\Partner;
use Tests\TestCase;
use App\PartnerRepresentative;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartnerRepresentativeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_retrieve_its_partner()
    {
        $partner = factory(Partner::class)->create();

        $representative = factory(PartnerRepresentative::class)->create([
            'partner_id' => $partner->id,
        ]);

        $retrievedPartner = $representative->partner;

        $this->assertSame($partner->id, $retrievedPartner->id);
    }
}

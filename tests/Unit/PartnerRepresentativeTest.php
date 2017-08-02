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

    /** @test */
    function can_have_an_optional_email_address()
    {
        $representativeA = factory(PartnerRepresentative::class)->create([
            'email' => 'henri@boucheriesanzot.be',
        ]);
        $representativeB = factory(PartnerRepresentative::class)->create([
            'email' => null,
        ]);

        $this->assertTrue($representativeA->hasEmail());
        $this->assertFalse($representativeB->hasEmail());
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function the_email_address_must_be_valid()
    {
        $representative = factory(PartnerRepresentative::class)->create([
            'email' => 'invalid-email-address',
        ]);
    }

    /** @test */
    function can_have_an_optional_phone_number()
    {
        $representativeA = factory(PartnerRepresentative::class)->make([
            'phone' => '+32489123456',
        ]);
        $representativeB = factory(PartnerRepresentative::class)->make([
            'phone' => null,
        ]);

        $this->assertTrue($representativeA->hasPhone());
        $this->assertFalse($representativeB->hasPhone());
    }
}

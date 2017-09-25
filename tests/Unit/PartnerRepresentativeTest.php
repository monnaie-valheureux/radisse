<?php

namespace Tests\Unit\Admin;

use App\Partner;
use Tests\TestCase;
use App\PartnerRepresentative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartnerRepresentativeTest extends TestCase
{
    use RefreshDatabase;

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
        $representativeA = factory(PartnerRepresentative::class)->make([
            'email' => 'henri@boucheriesanzot.be',
        ]);
        $representativeB = factory(PartnerRepresentative::class)->make([
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
        $representative = factory(PartnerRepresentative::class)->make([
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

    /**
     * @test
     * @expectedException DomainException
     */
    function the_phone_number_must_be_valid()
    {
        factory(PartnerRepresentative::class)->make(['phone' => 'invalid']);
    }

    /** @test */
    function the_phone_number_can_be_provided_in_multiple_formats()
    {
        // International format (E.164).
        factory(PartnerRepresentative::class)->make(['phone' => '+32489123456']);

        // National format, without spaces.
        factory(PartnerRepresentative::class)->make(['phone' => '0489123456']);

        // National format, with spaces.
        factory(PartnerRepresentative::class)->make(['phone' => '0489 12 34 56']);
        factory(PartnerRepresentative::class)->make(['phone' => '0489 123 456']);

        // Without leading zero.
        factory(PartnerRepresentative::class)->make(['phone' => '489 12 34 56']);
        factory(PartnerRepresentative::class)->make(['phone' => '489 123 456']);

        // With slash and dots.
        factory(PartnerRepresentative::class)->make(['phone' => '0489/12.34.56']);

        // Totally drunk…
        factory(PartnerRepresentative::class)->make(['phone' => '+32 (0) 48 9 123 4 56']);

        // If we got no exception until here, then everything is fine.
        // This is a workaround for the lack of an annotation that
        // would say we expect no exception to be thrown at all.
        // @see https://github.com/sebastianbergmann/phpunit-documentation/issues/171
        $this->assertTrue(true);
    }
}

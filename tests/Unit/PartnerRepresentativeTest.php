<?php

namespace Tests\Unit\Admin;

use App\Partner;
use Tests\TestCase;
use App\PartnerRepresentative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PartnerRepresentativeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_be_constructed_from_a_full_name_and_a_role()
    {
        $representative = PartnerRepresentative::fromFullNameAndRole(
            $givenName = 'Henri',
            $surname = 'Sanzot',
            $role = 'gérant'
        );

        $this->assertInstanceOf(PartnerRepresentative::class, $representative);
        $this->assertSame('Henri', $representative->given_name);
        $this->assertSame('Sanzot', $representative->surname);
        $this->assertSame('gérant', $representative->role);
    }

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
    function can_be_associated_with_an_optional_email_address()
    {
        $representativeA = factory(PartnerRepresentative::class)->create();
        $representativeA->addEmail('henri@boucheriesanzot.be');

        $representativeB = factory(PartnerRepresentative::class)->create();

        $this->assertTrue($representativeA->hasEmail());
        $this->assertFalse($representativeB->hasEmail());
    }

    /** @test */
    function can_be_associated_with_an_optional_email_address_that_is_public()
    {
        $representativeA = factory(PartnerRepresentative::class)->create();
        $representativeA->addPublicEmail('contact@boucheriesanzot.be');

        $representativeB = factory(PartnerRepresentative::class)->create();
        $representativeB->addEmail('henri@boucheriesanzot.be');

        $this->assertTrue($representativeA->emails->first()->isPublic);
        $this->assertFalse($representativeB->emails->first()->isPublic);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function the_email_address_must_be_valid()
    {
        $representative = factory(PartnerRepresentative::class)->make();

        $representative->addEmail('invalid-email-address');
    }

    /** @test */
    function can_be_associated_with_an_optional_phone_number()
    {
        $representativeA = factory(PartnerRepresentative::class)->create();
        $representativeA->addPhone('+32489123456');

        $representativeB = factory(PartnerRepresentative::class)->create();

        $this->assertTrue($representativeA->hasPhone());
        $this->assertFalse($representativeB->hasPhone());
    }

    /** @test */
    function can_be_associated_with_an_optional_phone_number_that_is_public()
    {
        $representativeA = factory(PartnerRepresentative::class)->create();
        $representativeA->addPublicPhone('+32489123456');

        $representativeB = factory(PartnerRepresentative::class)->create();
        $representativeB->addPhone('+32489654321');

        $this->assertTrue($representativeA->phones->first()->isPublic);
        $this->assertFalse($representativeB->phones->first()->isPublic);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function the_phone_number_must_be_valid()
    {
        $representative = factory(PartnerRepresentative::class)->make();

        $representative->addPhone('invalid');
    }

    /** @test */
    function the_phone_number_can_be_provided_in_multiple_formats()
    {
        $representative = factory(PartnerRepresentative::class)->create();

        // International format (E.164).
        $representative->addPhone('+32489123456');

        // National format, without spaces.
        $representative->addPhone('0489123456');

        // National format, with spaces.
        $representative->addPhone('0489 12 34 56');
        $representative->addPhone('0489 123 456');

        // Without leading zero.
        $representative->addPhone('489 12 34 56');
        $representative->addPhone('489 123 456');

        // With slash and dots.
        $representative->addPhone('0489/12.34.56');

        // Totally drunk…
        $representative->addPhone('+32 (0) 48 9 123 4 56');

        // If we got no exception until here, then everything is fine.
        // This is a workaround for the lack of an annotation that
        // would say we expect no exception to be thrown at all.
        // @see https://github.com/sebastianbergmann/phpunit-documentation/issues/171
        $this->assertTrue(true);
    }
}

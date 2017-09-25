<?php

namespace Tests\Unit\Admin;

use App\Email;
use App\Phone;
use App\Partner;
use App\Location;
use Tests\TestCase;
use App\PostalAddress;
use App\SocialNetwork;
use App\PartnerRepresentative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PartnerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_generate_a_slug_from_the_name_when_creating_a_partner()
    {
        // Create a partner.
        $partner = factory(Partner::class)->create([
            'name' => 'Boucherie Sanzot',
            // Ensure there is no defined slug before creating the model.
            'slug' => null,
        ]);

        // Check that a slug has been properly generated.
        $this->assertSame('boucherie-sanzot', $partner->slug);
    }

    /** @test */
    public function do_not_automatically_generate_a_slug_if_one_is_already_defined()
    {
        // Create a partner.
        $partner = factory(Partner::class)->create([
            'name' => 'Boucherie Sanzot',
            // Ensure there IS a defined slug before creating the model.
            'slug' => 'my-special-slug',
        ]);

        // Check that the slug we provided has been kept as is,
        // that it had not been overwitten by a new one.
        $this->assertSame('my-special-slug', $partner->slug);
        $this->assertNotSame('boucherie-sanzot', $partner->slug);
    }

    /** @test */
    function can_retrieve_its_locations()
    {
        // Create a partner.
        $partner = factory(Partner::class)->create([
            'name' => 'Boucherie Sanzot',
        ]);

        // Then, create two locations for this partner.
        $location1 = factory(Location::class)->create([
            'name' => 'Magasin rue du Nord',
            'partner_id' => $partner->id,
        ]);
        $location2 = factory(Location::class)->create([
            'name' => 'Magasin rue du Sud',
            'partner_id' => $partner->id,
        ]);

        // Retrieve the locations.
        $locations = $partner->locations;

        // Check that we got the correct locations.
        $this->assertCount(2, $locations);

        $this->assertSame($location1->id, $locations[0]->id);
        $this->assertSame('Magasin rue du Nord', $locations[0]->name);

        $this->assertSame($location2->id, $locations[1]->id);
        $this->assertSame('Magasin rue du Sud', $locations[1]->name);
    }

    /** @test */
    function can_retrieve_its_representatives()
    {
        $partner = factory(Partner::class)->create([
            'name' => 'Poissonnerie Ordralfabétix',
        ]);

        $personA = factory(PartnerRepresentative::class)->create([
            'partner_id' => $partner->id,
            'given_name' => 'Ordralfabétix',
            'role' => 'gérant',
        ]);
        $personB = factory(PartnerRepresentative::class)->create([
            'partner_id' => $partner->id,
            'given_name' => 'Iélosubmarine',
            'role' => 'gérante',
        ]);

        $representatives = $partner->representatives;

        $this->assertCount(2, $representatives);

        $this->assertSame($personA->id, $representatives[0]->id);
        $this->assertSame('Ordralfabétix', $representatives[0]->given_name);
        $this->assertSame('gérant', $representatives[0]->role);

        $this->assertSame($personB->id, $representatives[1]->id);
        $this->assertSame('Iélosubmarine', $representatives[1]->given_name);
        $this->assertSame('gérante', $representatives[1]->role);
    }

    /** @test */
    function can_retrieve_its_contact_details()
    {
        $partner = factory(Partner::class)->create([
            'name' => 'Boucherie Sanzot',
        ]);

        // Create different types of contact details.
        $address = PostalAddress::fromArray([
            'recipient' => 'Boucherie Sanzot',
            'street' => 'rue du Château',
            'street_number' => '1',
            'letter_box' => null,
            'postal_code' => '1234',
            'city' => 'Moulinsart',
            'latitude' => null,
            'longitude' => null,
        ]);
        $phone = Phone::fromNumber('+32489123456');
        $email = Email::fromAddress('henri@boucheriesanzot.be');
        $network = SocialNetwork::fromUrl('https://www.facebook.com/boucheriesanzot');

        // Save the contact details.
        $partner->postalAddress()->save($address);
        $partner->phones()->save($phone);
        $partner->emails()->save($email);
        $partner->socialNetworks()->save($network);

        // Finally, we test that we can properly get everything back.

        // Postal address.
        $this->assertInstanceOf(PostalAddress::class, $partner->postalAddress);
        $this->assertSame($address->id, $partner->postalAddress->id);

        // Phone numbers.
        $this->assertCount(1, $partner->phones);
        $this->assertInstanceOf(Phone::class, $partner->phones[0]);
        $this->assertSame($phone->id, $partner->phones[0]->id);

        // E-mail addresses.
        $this->assertCount(1, $partner->emails);
        $this->assertInstanceOf(Email::class, $partner->emails[0]);
        $this->assertSame($email->id, $partner->emails[0]->id);

        // Social networks.
        $this->assertCount(1, $partner->socialNetworks);
        $this->assertInstanceOf(SocialNetwork::class, $partner->socialNetworks[0]);
        $this->assertSame($network->id, $partner->socialNetworks[0]->id);
    }
}

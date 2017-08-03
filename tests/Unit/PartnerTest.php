<?php

namespace Tests\Unit\Admin;

use App\Partner;
use App\Location;
use Tests\TestCase;
use App\PartnerRepresentative;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartnerTest extends TestCase
{
    use DatabaseMigrations;

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
}

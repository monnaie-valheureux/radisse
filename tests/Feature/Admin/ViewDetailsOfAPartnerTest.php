<?php

namespace Tests\Feature\Admin;

use App\Partner;
use App\TeamMember;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ViewDetailsOfAPartnerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admins_can_see_a_particular_partner()
    {
        // Create two partners.
        $partner = factory(Partner::class)->create([
            'name' => 'Du côté de chez Poje',
            'name_sort' => 'Poje (du côté de chez)',
            'business_type' => 'SPRL',
        ]);
        $otherPartner = factory(Partner::class)->create([
            'name' => 'Boucherie Sanzot',
        ]);

        $teamMember = factory(TeamMember::class)->create();

        $response = $this->actingAs($teamMember)
                         ->followingRedirects()
                         ->get('/gestion/partenaires/'.$partner->slug);

        // Check that we can see the details of a specific partner.
        $response->assertSeeText($partner->name);
        $response->assertSeeText($partner->name_sort);
        $response->assertSeeText($partner->business_type);

        // Check that we don’t see anything related to the other partner.
        $response->assertDontSeeText($otherPartner->name);
    }
}

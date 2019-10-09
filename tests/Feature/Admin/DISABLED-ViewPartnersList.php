<?php

namespace Tests\Feature\Admin;

use App\Partner;
use App\TeamMember;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ViewPartnersListTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected $teamMember;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a team member.
        $this->teamMember = factory(TeamMember::class)->create([
            'email' => 'john.doe@radisse.test',
            'password' => 'secret',
        ]);

        // Manually log the member in.
        $this->be($this->teamMember);
    }

    /** @test */
    public function admins_can_see_the_list_of_partners()
    {
        // Create three partners.
        $partnerA = factory(Partner::class)->create(['name_sort' => 'Boucherie Sanzot']);
        $partnerB = factory(Partner::class)->create(['name_sort' => 'Du côté de chez Poje']);
        $partnerC = factory(Partner::class)->create(['name_sort' => 'Poissonnerie Ordralfabétix']);

        $response = $this->get('/gestion/partenaires');

        // Check if the created partners are listed on the page.
        $response->assertSeeText($partnerA->name_sort);
        $response->assertSeeText($partnerB->name_sort);
        $response->assertSeeText($partnerC->name_sort);
    }
}

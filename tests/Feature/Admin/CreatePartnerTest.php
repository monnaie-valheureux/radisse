<?php

namespace Tests\Feature\Admin;

use App\TeamMember;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreatePartnerTest extends TestCase
{
    use RefreshDatabase;

    protected $teamMember;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        // Create a team member.
        $this->teamMember = factory(TeamMember::class)->create();

        // Manually log the member in.
        $this->be($this->teamMember);
    }

    /** @test */
    function can_create_a_new_partner_by_providing_the_partner_name()
    {
        $this->assertAuthenticated();
    }
}

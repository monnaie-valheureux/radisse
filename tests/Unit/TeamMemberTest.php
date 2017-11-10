<?php

namespace Tests\Unit\Admin;

use App\Team;
use App\Partner;
use App\TeamMember;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TeamMemberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_retrieve_its_team()
    {
        // Create a team and a team member.
        $team = factory(Team::class)->create();

        $teamMember = factory(TeamMember::class)->create([
            'team_id' => $team->id,
        ]);

        // Retrieve the member’s team.
        $retrievedTeam = $teamMember->team;

        // Check that we got the correct data.
        $this->assertEquals($team->id, $retrievedTeam->id);
    }

    /** @test */
    function can_retrieve_its_endorsed_partners()
    {
        // Create a team member and two partners associated with it.
        $teamMember = factory(TeamMember::class)->create();

        $partners = factory(Partner::class, 2)->create([
            'endorser_team_member_id' => $teamMember->id,
        ]);

        // Retrieve the partners.
        $retrievedPartners = $teamMember->partners;

        // Check that we got the correct data.
        $this->assertEquals(
            $teamMember->id,
            $retrievedPartners->get(0)->endorser_team_member_id
        );
        $this->assertEquals(
            $teamMember->id,
            $retrievedPartners->get(1)->endorser_team_member_id
        );
    }
}

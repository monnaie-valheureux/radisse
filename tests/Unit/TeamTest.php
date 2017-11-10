<?php

namespace Tests\Unit\Admin;

use App\Team;
use App\TeamMember;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_retrieve_its_team_members()
    {
        // Create a team and then two members for that team.
        $team = factory(Team::class)->create();

        $members = factory(TeamMember::class, 2)->create([
            'team_id' => $team->id,
        ]);

        // Retrieve the members.
        $retrievedMembers = $team->members;

        // Check that we got the correct data.
        $this->assertEquals($team->id, $retrievedMembers->get(0)->team_id);
        $this->assertEquals($team->id, $retrievedMembers->get(1)->team_id);
    }
}

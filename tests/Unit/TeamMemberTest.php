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
    function automatically_hash_the_password()
    {
        $teamMember = factory(TeamMember::class)->create([
            'password' => 'secret'
        ]);

        $hash = app('hash')->make('secret');

        $this->assertNotSame('secret', $teamMember->password);
        $this->assertTrue(app('hash')->check('secret', $hash));
    }

    /** @test */
    public function can_generate_a_slug_from_the_full_name_when_creating_a_team_member()
    {
        $teamMember = factory(TeamMember::class)->create([
            'given_name' => 'John',
            'surname' => 'Doe',
            // Ensure there is no defined slug before creating the model.
            'slug' => null,
        ]);

        // Check that a slug has been properly generated.
        $this->assertSame('john-doe', $teamMember->slug);
    }

    /** @test */
    public function does_not_automatically_generate_a_slug_if_one_is_already_defined()
    {
        $teamMember = factory(TeamMember::class)->create([
            'given_name' => 'John',
            'surname' => 'Doe',
            // Ensure there IS a defined slug before creating the model.
            'slug' => 'my-special-slug',
        ]);

        // Check that the slug we provided has been kept as is,
        // that it had not been overwitten by a new one.
        $this->assertSame('my-special-slug', $teamMember->slug);
        $this->assertNotSame('john-doe', $teamMember->slug);
    }

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
    function can_retrieve_its_teammates()
    {
        // Create a team and a few team members.
        $team = factory(Team::class)->create();

        $teamMembers = factory(TeamMember::class, 3)->create([
            'team_id' => $team->id,
        ]);

        // Retrieve the teammates of the first team member.
        $retrievedTeamMembers = $teamMembers[0]->teammates;

        // Check that we got the correct data.
        $this->assertCount(2, $retrievedTeamMembers);
        $this->assertEquals($teamMembers[1]->id, $retrievedTeamMembers[0]->id);
        $this->assertEquals($teamMembers[2]->id, $retrievedTeamMembers[1]->id);

        // Ensure that the list of retrieved team members
        // does *not* include the initial team member.
        $this->assertNotContains(
            $teamMembers[0]->id,
            $retrievedTeamMembers->modelKeys(),
            'The list of retrieved teammates must not contain the initial team member.'
        );
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
        $retrievedPartners = $teamMember->endorsedPartners;

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

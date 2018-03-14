<?php

namespace Tests\Feature\Admin;

use App\TeamMember;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LogInToAdminAreaTest extends TestCase
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
        $this->teamMember = factory(TeamMember::class)->create([
            'email' => 'john.doe@radisse.test',
            // Bcrypt hash of the string ‘secret’, with a cost factor of 12.
            'password' => '$2y$12$GF73JIWsj7sQK0q35oA1d.R/BSIozS1e7hNspJJolUj0/gYZb9jL2',
        ]);
    }

    /** @test */
    function members_can_log_in_with_valid_credentials()
    {
        // Ensure that the member is not logged in.
        $this->assertGuest();

        $response = $this->post('/gestion/login', [
            'email' => 'john.doe@radisse.test',
            'password' => 'secret',
        ]);

        // Check that we are now logged in.
        $this->assertAuthenticated();
    }

    /** @test */
    function members_cannot_log_in_with_invalid_credentials()
    {
        // Ensure that the member is not logged in.
        $this->assertGuest();

        // Try to log in with an invalid e-mail address.
        $response = $this->post('/gestion/login', [
            'email' => 'john.doe@invalid-email.dev',
            'password' => 'secret',
        ]);

        // Check that we got an error.
        $response->assertSessionHasErrors('email');
        // Check that we are still not logged in.
        $this->assertGuest();


        // Try to log in with an invalid password.
        $response = $this->post('/gestion/login', [
            'email' => 'john.doe@radisse.test',
            'password' => 'invalid-password',
        ]);

        // Strangely, if the password is invalid, Laravel
        // associates the error with the `email` field…
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    function members_are_redirected_to_the_admin_home_page_after_login()
    {
        $response = $this->post('/gestion/login', [
            'email' => 'john.doe@radisse.test',
            'password' => 'secret',
        ]);

        $response->assertRedirect('/gestion');
    }

    /** @test */
    function members_who_are_not_logged_in_are_redirected_to_the_login_page()
    {
        // Try to access the admin home page without being logged in.
        $response = $this->get('/gestion');

        // Check that we’re properly redirected to the login page.
        $response->assertRedirect('/gestion/login');
    }

    /** @test */
    function members_can_log_out()
    {
        // Manually log the member in.
        $this->be($this->teamMember);

        $response = $this->post('/gestion/logout');

        // Check that we are not logged in any more.
        $this->assertGuest();
    }
}

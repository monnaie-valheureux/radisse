<?php

namespace Tests\Browser;

use App\TeamMember;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

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
        ]);
    }

    /** @test */
    public function members_can_log_in_with_valid_credentials()
    {
        $this->browse(function (Browser $browser) {
            $browser
                // Go to the login page.
                ->visit(route('login'))
                // Enter credentials and submit the form.
                ->type('email', 'john.doe@radisse.test')
                ->type('password', 'secret')
                ->press('submit')
                // We should then be authenticated and
                // redirected to the admin home page.
                ->assertRouteIs('admin-home')
                ->assertAuthenticated()
                // Make sure we log out, to prevent the following
                // tests to start with a logged in member.
                ->logout();
        });
    }

    /** @test */
    function members_cannot_log_in_with_invalid_email()
    {
        $this->browse(function (Browser $browser) {
            $browser
                // Go to the login page.
                ->visit(route('login'))
                // Enter wrong credentials and submit the form.
                ->type('email', 'john.doe@invalid-email.test')
                ->type('password', 'secret')
                ->press('submit')
                // After submitting the form, we should have
                // been redirected back to the login page.
                ->assertRouteIs('login')
                ->assertSee('adresse e-mail ou le mot de passe est incorrect')
                ->assertGuest();
        });
    }

    /** @test */
    function members_cannot_log_in_with_invalid_password()
    {
        $this->browse(function (Browser $browser) {
            $browser
                // Go to the login page.
                ->visit(route('login'))
                // Enter wrong credentials and submit the form.
                ->type('email', 'john.doe@radisse.test')
                ->type('password', 'invalid-password')
                ->press('submit')
                // After submitting the form, we should have
                // been redirected back to the login page.
                ->assertRouteIs('login')
                ->assertSee('adresse e-mail ou le mot de passe est incorrect')
                ->assertGuest();
        });
    }

    /** @test */
    function members_who_are_not_logged_in_are_redirected_to_the_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser
                // Try to access the admin home page without being logged in.
                ->visit(route('admin-home'))
                // Check that we’re properly redirected to the login page.
                ->assertRouteIs('login');
        });
    }

    /** @test */
    function members_can_log_out()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->teamMember)
                // Go to the admin home page.
                ->visit(route('admin-home'))
                ->screenshot('1')
                // Click the button to log out.
                ->with('.logout-form', function ($form) {
                    $form->screenshot('2')
                        ->press('submit');
                })
                // We should now be logged out.
                ->assertGuest();
        });
    }
}

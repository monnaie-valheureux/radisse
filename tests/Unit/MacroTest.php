<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Routing\Router;

class MacroTest extends TestCase
{
    /**
     * @test
     *
     * Test the Str::isBcryptHash() macro.
     */
    function can_check_if_a_string_looks_like_a_bcrypt_hash()
    {
        $hash = '$2y$04$pfbuiURJw2RWGDngwVx4GOvNvrRbal1P5pkjbF.LgPpg2LrIVSMi6';
        $nonHash = 'foo';

        $this->assertTrue(Str::isBcryptHash($hash));
        $this->assertFalse(Str::isBcryptHash($nonHash));
    }

    /**
     * @test
     *
     * Test the Router::isAdmin() macro.
     * This can be called on the `Route` facade, because the
     * `Router` is the actual class behind the facade.
     */
    function can_check_if_the_current_route_points_to_an_admin_page()
    {
        $publicPage = $this->get('/partenaires');
        $this->assertFalse(Router::isAdmin());

        $adminPage = $this->get('/gestion/partenaires');
        $this->assertTrue(Router::isAdmin());
    }
}

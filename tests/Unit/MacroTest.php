<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class MacroTest extends TestCase
{
    /** @test */
    function can_check_if_a_string_looks_like_a_bcrypt_hash()
    {
        $hash = '$2y$04$pfbuiURJw2RWGDngwVx4GOvNvrRbal1P5pkjbF.LgPpg2LrIVSMi6';
        $nonHash = 'foo';

        $this->assertTrue(Str::isBcryptHash($hash));
        $this->assertFalse(Str::isBcryptHash($nonHash));
    }
}

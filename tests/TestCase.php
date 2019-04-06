<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $bcrypt_cost;

    protected function setUp(): void
    {
        parent::setUp();

        // In order to greatly increase the speed of the tests, we configure the
        // Bcrypt hasher to use a cost factor of 4 (the smallest allowed value)
        // instead of the value that is configured in the application.
        $this->bcrypt_cost = config('hashing.bcrypt_cost');
        app('hash')->setRounds(4);
    }

    protected function tearDown(): void
    {
        // Set the Bcrypt cost factor back to its original value.
        app('hash')->setRounds($this->bcrypt_cost);

        parent::tearDown();
    }



}

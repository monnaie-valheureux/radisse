<?php

namespace Tests\Unit;

use App\Phone;
use Tests\TestCase;

class ContactDetailsPhoneTest extends TestCase
{
    /** @test */
    function it_extends_the_contact_details_class()
    {
        $phone = new Phone;

        $this->assertInstanceOf(\App\ContactDetails::class, $phone);
    }

    /** @test */
    function can_be_constructed_from_a_phone_number_string()
    {
        $phone = Phone::fromNumber('+32489123456');

        $this->assertInstanceOf(Phone::class, $phone);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function the_phone_number_must_be_valid()
    {
        Phone::fromNumber('invalid-phone-number');
    }

    /** @test */
    function object_exposes_the_number_as_a_property()
    {
        $phone = Phone::fromNumber('+32489123456');

        $this->assertTrue(property_exists($phone, 'number'));
    }

    /** @test */
    function updating_the_number_property_formats_it_in_international_format()
    {
        $phone = Phone::fromNumber('0489 12 34 56');

        $this->assertSame('+32 489 12 34 56', $phone->number);

        // Set a new number.
        $phone->number = '0489 65 43 21';

        $this->assertSame('+32 489 65 43 21', $phone->number);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function updating_the_number_property_with_an_invalid_number_throws_an_exception()
    {
        $phone = Phone::fromNumber('+32489123456');

        // Set a new number.
        $phone->number = 'invalid-phone-number';
    }

    /** @test */
    function can_format_number_in_national_format()
    {
        $phone = Phone::fromNumber('+32489123456');

        $this->assertSame('0489 12 34 56', $phone->toNationalFormat());
    }

    /** @test */
    function can_format_number_in_international_format()
    {
        $phone = Phone::fromNumber('+32489123456');

        $this->assertSame('+32 489 12 34 56', $phone->toInternationalFormat());
    }

    /** @test */
    function can_format_number_in_E164_format()
    {
        $phone = Phone::fromNumber('+32 489 12 34 56');

        $this->assertSame('+32489123456', $phone->toE164Format());
    }

    /** @test */
    function it_is_formatted_in_international_format_when_converted_to_a_string()
    {
        $phone = Phone::fromNumber('+32489123456');

        $this->assertSame('+32 489 12 34 56', $phone->__toString());
        $this->assertSame('+32 489 12 34 56', (string) $phone);
    }

    /** @test */
    function it_fills_its_properties_when_getting_the_model_from_the_database()
    {
        // Manually trigger database migrations.
        $this->runDatabaseMigrations();

        // Create and save a Phone model into the database.
        $phone = Phone::fromNumber('+32489123456')
            ->withLabel('Magasin')
            ->makePublic();
        // Fake data to satisfy database constraints.
        $phone->contactable_id = 1;
        $phone->contactable_type = 'foo';
        // Save the model.
        $phone->save();

        // Get the model from the database.
        $phone = Phone::first();

        $this->assertSame('Magasin', $phone->label);
        $this->assertTrue($phone->isPublic);
        $this->assertSame('+32489123456', $phone->number);
    }

    /**
     * We reimplement this method in order to be able to trigger it manually for
     * some specific tests instead of having it being automatically triggered
     * for every test in the file. This allows to make tests run faster.
     */
    protected function runDatabaseMigrations()
    {
        $this->artisan('migrate');

        $this->app[\Illuminate\Contracts\Console\Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }
}

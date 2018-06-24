<?php

namespace Tests\Unit;

use App\Email;
use Tests\TestCase;

class ContactDetailsEmailTest extends TestCase
{
    /** @test */
    function it_extends_the_contact_details_class()
    {
        $email = new Email;

        $this->assertInstanceOf(\App\ContactDetails::class, $email);
    }

    /** @test */
    function can_be_constructed_from_an_email_address()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        $this->assertInstanceOf(Email::class, $email);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function it_throws_an_exception_if_the_address_is_invalid()
    {
        Email::fromAddress('invalid-email-address');
    }

    /** @test */
    function object_exposes_the_address_local_part_as_a_property()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        $this->assertSame('henri', $email->localPart);
    }

    /** @test */
    function object_exposes_the_address_domain_as_a_property()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        $this->assertSame('boucheriesanzot.be', $email->domain);
    }

    /** @test */
    function object_exposes_address_as_a_property()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        $this->assertSame('henri@boucheriesanzot.be', $email->address);
    }

    /** @test */
    function updating_the_local_part_updates_the_whole_address()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        $this->assertSame('henri@boucheriesanzot.be', $email->address);

        // Set a new local part for the e-mail address.
        $email->localPart = 'info';

        $this->assertSame('info@boucheriesanzot.be', $email->address);
    }

    /** @test */
    function updating_the_domain_updates_the_whole_address()
    {
        $email = Email::fromAddress('info@boucheriesanzot.be');

        $this->assertSame('info@boucheriesanzot.be', $email->address);

        // Set a new domain for the e-mail address.
        $email->domain = 'poissonnerieordralfabetix.gaule';

        $this->assertSame('info@poissonnerieordralfabetix.gaule', $email->address);
    }

    /** @test */
    function updating_the_address_property_updates_the_local_part_and_the_domain()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        $this->assertSame('henri', $email->localPart);
        $this->assertSame('boucheriesanzot.be', $email->domain);

        // Set a new e-mail address.
        $email->address = 'info@poissonnerieordralfabetix.gaule';

        $this->assertSame('info', $email->localPart);
        $this->assertSame('poissonnerieordralfabetix.gaule', $email->domain);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function updating_the_address_property_with_an_invalid_address_throws_an_exception()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        // Set a new e-mail address.
        $email->address = 'invalid-email-address';
    }

    /** @test */
    function it_can_be_converted_to_an_html_link()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        // Since the e-mail address will be obfuscated in a different way
        // every time the method is called, we use a regular expression
        // instead of testing against an hardcoded string.
        $this->assertRegExp(
            '%<a href\="[0-9a-z&#;:._-]+">[0-9a-z&#;:._-]+<\/a>%',
            $email->asLink()
        );
    }

    /** @test */
    function it_is_transformed_to_the_email_address_when_converted_to_a_string()
    {
        $email = Email::fromAddress('henri@boucheriesanzot.be');

        $this->assertSame('henri@boucheriesanzot.be', $email->__toString());
        $this->assertSame('henri@boucheriesanzot.be', (string) $email);
    }
    /** @test */
    function it_gathers_the_correct_data_when_saving_the_model_to_the_database()
    {
        // Manually trigger database migrations.
        $this->runDatabaseMigrations();

        // Create and save an Email into the database.
        $email = Email::fromAddress('henri@boucheriesanzot.be')
            ->withLabel('Magasin')
            ->makePublic();
        // Fake data to satisfy database constraints.
        $email->contactable_id = 1;
        $email->contactable_type = 'foo';
        // Save the model.
        $email->save();

        $this->assertDatabaseHas('contact_details', [
            'type' => 'email',
            'data' => json_encode([
                'isPublic' => true,
                'label' => 'Magasin',
                'address' => 'henri@boucheriesanzot.be',
            ]),
        ]);
    }

    /** @test */
    function it_fills_its_properties_when_getting_the_model_from_the_database()
    {
        // Manually trigger database migrations.
        $this->runDatabaseMigrations();

        // Create and save an Email model into the database.
        $email = Email::fromAddress('henri@boucheriesanzot.be')
            ->withLabel('Magasin')
            ->makePublic();
        // Fake data to satisfy database constraints.
        $email->contactable_id = 1;
        $email->contactable_type = 'foo';
        // Save the model.
        $email->save();

        // Get the model from the database.
        $email = Email::first();

        $this->assertSame('Magasin', $email->label);
        $this->assertTrue($email->isPublic);
        $this->assertSame('henri@boucheriesanzot.be', $email->address);
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

<?php

namespace Tests\Unit;

use App\Website;
use Tests\TestCase;

class ContactDetailsWebsiteTest extends TestCase
{
    /** @test */
    function it_extends_the_contact_details_class()
    {
        $site = new Website;

        $this->assertInstanceOf(\App\ContactDetails::class, $site);
    }

    /** @test */
    function can_be_constructed_from_a_url()
    {
        $site = Website::fromUrl('boucheriesanzot.be');

        $this->assertInstanceOf(Website::class, $site);
    }

    /** @test */
    function object_exposes_the_url_as_a_property()
    {
        $site = Website::fromUrl('boucheriesanzot.be');

        // Test that we can read the property.
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // Then, test that we can write the property, by
        // changing its value and reading it again.
        $site->url = 'otherurl.be';
        $this->assertSame('http://otherurl.be', $site->url);
    }

    /** @test */
    function object_exposes_the_url_without_protocol_as_a_property()
    {
        $site = Website::fromUrl('http://boucheriesanzot.be');

        // Test that we can read the property.
        $this->assertSame('boucheriesanzot.be', $site->urlWithoutProtocol);

        // Then, test that we can write the property, by
        // changing its value and reading it again.
        $site->urlWithoutProtocol = 'otherurl.be';
        $this->assertSame('otherurl.be', $site->urlWithoutProtocol);
    }

    /** @test */
    function object_exposes_the_https_status_as_a_property()
    {
        $site = Website::fromUrl('http://boucheriesanzot.be');

        // Test that we can read the property.
        $this->assertFalse($site->useHttps);

        $site = Website::fromUrl('https://boucheriesanzot.be');
        $this->assertTrue($site->useHttps);

        // Ensure that, if no protocol is provided, HTTP is used by default.
        $site = Website::fromUrl('boucheriesanzot.be');
        $this->assertFalse($site->useHttps);

        // Then, test that we can write the property, by
        // changing its value and reading it again.
        $site->useHttps = true;
        $this->assertTrue($site->useHttps);
        $this->assertSame('https://boucheriesanzot.be', $site->url);
    }

    /** @test */
    function updating_the_url_property_updates_the_url_without_protocol_and_the_https_status()
    {
        $site = Website::fromUrl('https://boucheriesanzot.be');

        // Check the initial state of these properties.
        $this->assertSame('boucheriesanzot.be', $site->urlWithoutProtocol);
        $this->assertTrue($site->useHttps);

        // Set a new URL.
        $site->url = 'http://poissonnerieordralfabetix.be';

        // Ensure that the properties have been updated.
        $this->assertSame('http://poissonnerieordralfabetix.be', $site->url);
        $this->assertSame('poissonnerieordralfabetix.be', $site->urlWithoutProtocol);
        $this->assertFalse($site->useHttps);
    }

    /** @test */
    function it_accepts_urls_with_or_without_protocol()
    {
        // No protocol in input, `http` protocol in output.
        $site = Website::fromUrl('boucheriesanzot.be');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // `http` in, `http` out.
        $site = Website::fromUrl('http://boucheriesanzot.be');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // `https` in, `https` out.
        $site = Website::fromUrl('https://boucheriesanzot.be');
        $this->assertSame('https://boucheriesanzot.be', $site->url);
    }

    /** @test */
    function it_detects_websites_using_https()
    {
        // By default, HTTP is used.
        $site = Website::fromUrl('boucheriesanzot.be');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // Explicitly use an `HTTP` protocol.
        $site = Website::fromUrl('http://boucheriesanzot.be');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // Explicitly use an `HTTPS` protocol.
        $site = Website::fromUrl('https://boucheriesanzot.be');
        $this->assertSame('https://boucheriesanzot.be', $site->url);
    }

    /** @test */
    function it_can_handle_leading_or_trailing_spaces_in_the_provided_url()
    {
        // One leading space character.
        $site = Website::fromUrl(' http://boucheriesanzot.be');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // Multiple leading space characters.
        $site = Website::fromUrl('   http://boucheriesanzot.be');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // One trailing space character.
        $site = Website::fromUrl('http://boucheriesanzot.be ');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // Multiple trailing space characters.
        $site = Website::fromUrl('http://boucheriesanzot.be   ');
        $this->assertSame('http://boucheriesanzot.be', $site->url);

        // If we got no exception until here, then everything is fine.
        // This is a workaround for the lack of an annotation that
        // would say we expect no exception to be thrown at all.
        // @see https://github.com/sebastianbergmann/phpunit-documentation/issues/171
        $this->assertTrue(true);
    }

    /** @test */
    function it_is_transformed_to_the_url_when_converted_to_a_string()
    {
        $site = Website::fromUrl('http://boucheriesanzot.be');

        $this->assertSame('http://boucheriesanzot.be', $site->__toString());
        $this->assertSame('http://boucheriesanzot.be', (string) $site);
    }

    /** @test */
    function it_gathers_the_correct_data_when_saving_the_model_to_the_database()
    {
        // Manually trigger database migrations.
        $this->runDatabaseMigrations();

        // Create and save a Website into the database.
        $site = Website::fromUrl('boucheriesanzot.be')
            ->withLabel('Site de la boucherie')
            ->makePublic();
        // Fake data to satisfy database constraints.
        $site->contactable_id = 1;
        $site->contactable_type = 'foo';
        // Save the model.
        $site->save();

        $this->assertDatabaseHas('contact_details', [
            'type' => 'website',
            'data' => json_encode([
                'isPublic' => true,
                'label' => 'Site de la boucherie',
                'url' => 'http://boucheriesanzot.be',
            ]),
        ]);
    }

    /** @test */
    function it_fills_its_properties_when_getting_the_model_from_the_database()
    {
        // Manually trigger database migrations.
        $this->runDatabaseMigrations();

        // Create and save a Website model into the database.
        $site = Website::fromUrl('boucheriesanzot.be')
            ->withLabel('Site de la boucherie')
            ->makePublic();
        // Fake data to satisfy database constraints.
        $site->contactable_id = 1;
        $site->contactable_type = 'foo';
        // Save the model.
        $site->save();

        // Get the model from the database.
        $site = Website::first();

        $this->assertSame('Site de la boucherie', $site->label);
        $this->assertTrue($site->isPublic);
        $this->assertSame('http://boucheriesanzot.be', $site->url);
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

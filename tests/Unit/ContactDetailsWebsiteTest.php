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
        $this->assertSame('boucheriesanzot.be', $site->url);

        // Then, test that we can write the property, by
        // changing its value and reading it again.
        $site->url = 'otherurl.be';
        $this->assertSame('otherurl.be', $site->url);
    }

    /** @test */
    function it_is_transformed_to_the_url_when_converted_to_a_string()
    {
        $site = Website::fromUrl('boucheriesanzot.be');

        $this->assertSame('boucheriesanzot.be', $site->__toString());
        $this->assertSame('boucheriesanzot.be', (string) $site);
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
                'url' => 'boucheriesanzot.be',
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
        $this->assertSame('boucheriesanzot.be', $site->url);
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

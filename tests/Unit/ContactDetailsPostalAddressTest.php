<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\PostalAddress;

class ContactDetailsPostalAddressTest extends TestCase
{
    // Modifier les tests
    // Tous les désactiver
    // Les réactiver un par un pour guider l’implémentation
    // Idéalement, ne rien implémenter sans avoir de test qui couvre ce code

    /** @test */
    function it_extends_the_contact_details_class()
    {
        $address = new PostalAddress;

        $this->assertInstanceOf(\App\ContactDetails::class, $address);
    }

    /** @test */
    function can_be_constructed_from_an_array()
    {
        $address = PostalAddress::fromArray([
            'recipient' => 'Boucherie Sanzot',
            'street' => 'rue du Château',
            'street_number' => '1',
            'letter_box' => null,
            'postal_code' => '1234',
            'city' => 'Moulinsart',
            'latitude' => null,
            'longitude' => null,
        ]);

        $this->assertInstanceOf(PostalAddress::class, $address);
    }

    /** @test */
    function the_street_number_is_optional()
    {
        $address = $this->makeTestAddress(['street_number' => null]);

        $this->assertInstanceOf(PostalAddress::class, $address);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function it_throws_an_exception_if_a_required_address_component_is_missing()
    {
        // We try to create an address with no info except a street name.
        // This is obviously not enough to have a valid address.
        PostalAddress::fromArray(['street' => 'rue du Château']);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function it_throws_an_exception_if_the_postal_code_looks_invalid()
    {
        $this->makeTestAddress(['postal_code' => 'invalid-postal-code']);
    }

    /** @test */
    function object_exposes_the_recipient_as_a_property()
    {
        $address = $this->makeTestAddress(['recipient' => 'Boucherie Sanzot']);

        $this->assertSame('Boucherie Sanzot', $address->recipient);
    }

    /** @test */
    function object_exposes_the_street_name_as_a_property()
    {
        $address = $this->makeTestAddress(['street' => 'rue du Château']);

        $this->assertSame('rue du Château', $address->street);
    }

    /** @test */
    function object_exposes_the_street_number_as_a_property()
    {
        $address = $this->makeTestAddress(['street_number' => '1']);

        $this->assertSame('1', $address->streetNumber);


        $address = $this->makeTestAddress(['street_number' => null]);

        $this->assertSame(null, $address->streetNumber);
    }

    /** @test */
    function object_exposes_the_letter_box_number_as_a_property()
    {
        $address = $this->makeTestAddress(['letter_box' => '5']);

        $this->assertSame('5', $address->letterBox);
    }

    /** @test */
    function object_exposes_the_postal_code_as_a_property()
    {
        $address = $this->makeTestAddress(['postal_code' => '1234']);

        $this->assertSame('1234', $address->postalCode);
    }

    /** @test */
    function object_exposes_the_city_as_a_property()
    {
        $address = $this->makeTestAddress(['city' => 'Moulinsart']);

        $this->assertSame('Moulinsart', $address->city);
    }

    /** @test */
    function object_exposes_the_latitude_as_a_property()
    {
        $address = $this->makeTestAddress(['latitude' => 50.671155]);

        $this->assertSame(50.671155, $address->latitude);
    }

    /** @test */
    function object_exposes_the_longitude_as_a_property()
    {
        $address = $this->makeTestAddress(['longitude' => 4.612869]);

        $this->assertSame(4.612869, $address->longitude);
    }

    /**
     * @test
     * @expectedException DomainException
     */
    function updating_an_address_component_with_an_invalid_value_throws_an_exception()
    {
        $address = $this->makeTestAddress();

        // Set a new, invalid postal code.
        $address->postalCode = 'invalid-postal-code';
    }

    /** @test */
    function it_can_format_the_postal_address_as_a_string()
    {
        $address = $this->makeTestAddress();

        $this->assertSame(
            "Rue du Château 1\n".
            "Moulinsart",
            $address->toString()
        );

        // Ensure it also works well without any street number.
        $address = $this->makeTestAddress(['street_number' => null]);

        $this->assertSame(
            "Rue du Château\n".
            "Moulinsart",
            $address->toString()
        );
    }

    /** @test */
    function it_can_format_the_address_as_a_string_for_postal_mail_delivery()
    {
        $address = $this->makeTestAddress()->asPostalMail();

        $this->assertSame(
            "Boucherie Sanzot\n".
            "Rue du Château 1\n".
            "1234 Moulinsart",
            $address->toString()
        );

        // Ensure it also works well without any street number.
        $address = $this->makeTestAddress(['street_number' => null])->asPostalMail();

        $this->assertSame(
            "Boucherie Sanzot\n".
            "Rue du Château\n".
            "1234 Moulinsart",
            $address->toString()
        );
    }

    /** @test */
    function it_can_format_the_postal_address_in_an_html_format()
    {
        $address = $this->makeTestAddress();

        $this->assertSame(
            '<p class="h-adr" translate="no">'."\n".
            '<span class="p-street-address">Rue du Château 1</span><br>'."\n".
            '<span class="p-locality">Moulinsart</span>'."\n".
            '</p>',
            $address->toHtml()
        );

        // Ensure it also works well without any street number.
        $address = $this->makeTestAddress(['street_number' => null]);

        $this->assertSame(
            '<p class="h-adr" translate="no">'."\n".
            '<span class="p-street-address">Rue du Château</span><br>'."\n".
            '<span class="p-locality">Moulinsart</span>'."\n".
            '</p>',
            $address->toHtml()
        );
    }

    /** @test */
    function it_can_format_the_address_as_html_for_postal_mail_delivery()
    {
        $address = $this->makeTestAddress()->asPostalMail();

        $this->assertSame(
            '<div class="h-card" translate="no">'.
                '<p class="p-name">Boucherie Sanzot</p>'.
                '<p class="p-adr h-adr">'.
                    '<span class="p-street-address">Rue du Château 1</span><br>'.
                    '<span class="p-postal-code">1234</span> '.
                    '<span class="p-locality">Moulinsart</span>'.
                '</p>'.
            '</div>',
            $address->toHtml()
        );

        // Ensure it also works well without any street number.
        $address = $this->makeTestAddress(['street_number' => null])->asPostalMail();

        $this->assertSame(
            '<div class="h-card" translate="no">'.
                '<p class="p-name">Boucherie Sanzot</p>'.
                '<p class="p-adr h-adr">'.
                    '<span class="p-street-address">Rue du Château</span><br>'.
                    '<span class="p-postal-code">1234</span> '.
                    '<span class="p-locality">Moulinsart</span>'.
                '</p>'.
            '</div>',
            $address->toHtml()
        );
    }

    /** @test */
    function it_is_transformed_to_the_postal_address_when_converted_to_a_string()
    {
        $address = $this->makeTestAddress();

        $this->assertSame(
            "Rue du Château 1\n".
            "Moulinsart",
            $address->__toString()
        );
        $this->assertSame(
            "Rue du Château 1\n".
            "Moulinsart",
            (string) $address
        );
    }

    /** @test */
    function it_handles_the_letter_box_number_when_formatting_the_address_for_postal_mail_delivery()
    {
        $address = $this->makeTestAddress(['letter_box' => '5'])->asPostalMail();

        $this->assertSame(
            "Boucherie Sanzot\n".
            // The letter box number is added to this line.
            // /!\ This is specific to Belgian postal services /!\
            "Rue du Château 1 bte 5\n".
            "1234 Moulinsart",
            $address->__toString()
        );
    }

    /** @test */
    function it_gathers_the_correct_data_when_saving_the_model_to_the_database()
    {
        // Manually trigger database migrations.
        $this->runDatabaseMigrations();

        // Create and save a PostalAddress into the database.
        $address = $this->makeTestAddress()->withLabel('Magasin')->makePublic();
        // Fake data to satisfy database constraints.
        $address->contactable_id = 1;
        $address->contactable_type = 'foo';
        // Save the model.
        $address->save();

        $this->assertDatabaseHas('contact_details', [
            'type' => 'postal-address',
            'data' => json_encode([
                'isPublic' => true,
                'label' => 'Magasin',
                'parts' => [
                    'recipient' => 'Boucherie Sanzot',
                    'street' => 'rue du Château',
                    'street_number' => '1',
                    'letter_box' => null,
                    'postal_code' => '1234',
                    'city' => 'Moulinsart',
                    'latitude' => 50.671155,
                    'longitude' => 4.612869,
                ],
            ]),
        ]);
    }

    /** @test */
    function it_fills_its_properties_when_getting_the_model_from_the_database()
    {
        // Manually trigger database migrations.
        $this->runDatabaseMigrations();

        // Create and save a PostalAddress model into the database.
        $address = $this->makeTestAddress()->withLabel('Magasin')->makePublic();
        // Fake data to satisfy database constraints.
        $address->contactable_id = 1;
        $address->contactable_type = 'foo';
        // Save the model.
        $address->save();

        // Get the model from the database.
        $address = PostalAddress::first();

        $this->assertSame('Magasin', $address->label);
        $this->assertTrue($address->isPublic);
        $this->assertSame('Boucherie Sanzot', $address->recipient);
        $this->assertSame('rue du Château', $address->street);
        $this->assertSame('1', $address->streetNumber);
        $this->assertSame(null, $address->letterBox);
        $this->assertSame('1234', $address->postalCode);
        $this->assertSame('Moulinsart', $address->city);
        $this->assertSame(50.671155, $address->latitude);
        $this->assertSame(4.612869, $address->longitude);
    }

    /**
     * Helper method to avoid redundancy in tests.
     *
     * @param  array  $overwrite  An array of address components that should
     *                            overwrite the default values.
     *
     * @return \App\PostalAddress
     */
    protected function makeTestAddress(array $overwrite = [])
    {
        $addressParts = [
            'recipient' => 'Boucherie Sanzot',
            'street' => 'rue du Château',
            'street_number' => '1',
            'letter_box' => null,
            'postal_code' => '1234',
            'city' => 'Moulinsart',
            'latitude' => 50.671155,
            'longitude' => 4.612869,
        ];

        return PostalAddress::fromArray($overwrite + $addressParts);
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

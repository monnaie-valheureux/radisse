<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\ContactDetails;

class ContactDetailsTest extends TestCase
{
    /** @test */
    function object_exposes_a_read_only_type_property()
    {
        $contactInfo = new ContactDetails;

        $this->assertTrue(property_exists($contactInfo, 'type'));

        // Artifically set a value to the property.
        $reflectionClass = new \ReflectionClass($contactInfo);
        $property = $reflectionClass->getProperty('type');
        $property->setAccessible(true);
        $property->setValue($contactInfo, 'foo');

        // Check that the value was properly set.
        $this->assertSame('foo', $contactInfo->type);

        // Try to change the value of the property.
        $this->type = 'bar';

        // Test that it did not change and that it still has the previous value.
        $this->assertSame('foo', $contactInfo->type);
    }

    /** @test */
    function object_exposes_a_property_telling_if_the_stored_info_is_public()
    {
        $contactInfo = new ContactDetails;

        $this->assertTrue(property_exists($contactInfo, 'isPublic'));

        $contactInfo->isPublic = false;

        // Check just to be sure that the value was properly set.
        $this->assertFalse($contactInfo->isPublic);

        $contactInfo->isPublic = true;

        $this->assertTrue($contactInfo->isPublic);

        // Test the `isPrivate` counterpart.
        $contactInfo->isPrivate = true;

        $this->assertTrue($contactInfo->isPrivate);
        // Make sure that updating `isPrivate` changed the value of `isPublic`.
        $this->assertFalse($contactInfo->isPublic);
    }

    /** @test */
    function the_stored_info_is_private_by_default()
    {
        $contactInfo = new ContactDetails;

        $this->assertFalse($contactInfo->isPublic);
        $this->assertTrue($contactInfo->isPrivate);
    }

    /** @test */
    function the_public_state_of_the_stored_info_can_be_changed_using_a_method()
    {
        $contactInfo = new ContactDetails;
        $contactInfo->isPublic = false;

        $contactInfo->makePublic();

        $this->assertTrue($contactInfo->isPublic);

        // Test the `makePrivate()` counterpart.
        $contactInfo->makePrivate();

        $this->assertTrue($contactInfo->isPrivate);

        // Test the `setVisibility()` method, which takes a boolean.
        $contactInfo->setVisibility(true);

        $this->assertTrue($contactInfo->isPublic);
        $this->assertFalse($contactInfo->isPrivate);
    }

    /** @test */
    function object_exposes_label_as_a_property()
    {
        $contactInfo = new ContactDetails;

        $this->assertTrue(property_exists($contactInfo, 'label'));
    }

    /** @test */
    function a_label_can_be_added_to_an_existing_contact_info_using_a_property()
    {
        $contactInfo = new ContactDetails;

        $this->assertNull($contactInfo->label);

        $contactInfo->label = 'An awesome label';

        $this->assertSame('An awesome label', $contactInfo->label);
    }

    /** @test */
    function a_label_can_be_added_to_an_existing_contact_info_using_a_method()
    {
        $contactInfo = new ContactDetails;

        $this->assertNull($contactInfo->label);

        $contactInfo->withLabel('An awesome label');

        $this->assertSame('An awesome label', $contactInfo->label);
    }

    /** @test */
    function a_label_can_be_removed_from_an_existing_contact_info()
    {
        $contactInfo = new ContactDetails;
        $contactInfo->label = 'An awesome label';

        $this->assertSame('An awesome label', $contactInfo->label);

        // Setting the label to an empty string should make it null.
        $contactInfo->label = '';

        $this->assertNull($contactInfo->label);

        // Of course, explicitly setting it to null will keep it null.
        $contactInfo->label = null;

        $this->assertNull($contactInfo->label);
    }
}

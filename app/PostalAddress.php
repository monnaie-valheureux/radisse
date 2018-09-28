<?php

namespace App;

use stdClass;
use DomainException;

class PostalAddress extends ContactDetails
{
    /**
     * The type of contact info stored by the object.
     *
     * @var string
     */
    protected $type = 'postal-address';

    /**
     * The components of the postal address.
     *
     * @var \stdClass
     */
    protected $parts;

    /**
     * Create a new instance from an array of address components.
     *
     * @param  array  $parts
     *
     * @return self
     */
    public static function fromArray(array $parts)
    {
        $address = new self;

        // Convert the array of data to an instance of \stdClass.
        $parts = (object) $parts;

        // Ensure we got the required address components.
        $address->validateAddress($parts);

        // We store the components of the address, not the address itself.
        $address->parts = $parts;

        return $address;
    }

    /**
     * Update one or more components of the address.
     *
     * @param  array  $parts
     *
     * @return self
     */
    public function modify($parts)
    {
        foreach ($parts as $part => $value) {
            // Calling the magic method allows us to centralize validation
            // and formatting there instead of duplicating code.
            $this->__set($part, $value);
        }

        return $this;
    }

    /**
     * Helper method to format an address line from address parts.
     *
     * @param  \stdClass  $parts
     *
     * @return string
     */
    protected function formatAddressLine(stdClass $parts)
    {
        $addressLine = $parts->street.' '.$parts->street_number;

        if (isset($parts->letter_box)) {
            $addressLine .= ' bte '.$parts->letter_box;
        }

        return $addressLine;
    }

    /**
     * Check if a given postal address is valid.
     *
     * @param  array|stdClass  $parts
     *
     * @return void
     *
     * @throws \DomainException if the postal address is invalid.
     */
    protected function validateAddress($parts)
    {
        $requiredParts = ['street', 'postal_code', 'city'];

        foreach ($requiredParts as $part) {
            if (empty($parts->{$part})) {
                throw new DomainException(
                    "Missing [{$part}] component in postal address."
                );
            }
        }

        // The postal code must be composed of exactly four digits.
        // See http://www.upu.int/fileadmin/documentsFiles/activities/addressingUnit/belEn.pdf
        if (!preg_match('#^[0-9]{4}$#', $parts->postal_code)) {
            throw new DomainException(
                "Postal code [{$parts->postal_code}] is invalid."
            );
        }
    }

    /**
     * Get the key-value pairs of data that are specific to this type of contact info.
     *
     * @return array
     */
    protected function getOwnAttributes()
    {
        return [
            'parts' => $this->parts,
        ];
    }

    /**
     * Allow to read specific properties as if they were public.
     *
     * @param  string  $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case 'recipient':
            case 'street':
            case 'streetNumber':
            case 'letterBox':
            case 'postalCode':
            case 'city':
            case 'latitude':
            case 'longitude':
                return $this->parts->{snake_case($name)};
        }

        return parent::__get($name);
    }

    /**
     * Allow to write specific properties as if they were public.
     *
     * @param string  $name
     * @param mixed   $value
     */
    public function __set($name, $value)
    {
        switch ($name) {
            case 'recipient':
            case 'street':
            case 'streetNumber':
            case 'street_number':
            case 'letterBox':
            case 'letter_box':
            case 'postalCode':
            case 'postal_code':
            case 'city':
            case 'latitude':
            case 'longitude':
                // Update the value.
                $this->parts->{snake_case($name)} = $value;

                // Ensure we got the required address components.
                $this->validateAddress($this->parts);
                break;
            default:
                // Fall back on the magic method of the parent.
                parent::__set($name, $value);
                break;
        }
    }

    /**
     * Return the address as a formatted string of text.
     *
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Return a simplified address as a formatted string of text.
     *
     * This is similar to what `toString()` does except that addresses
     * returned by this method do not include postal code nor country.
     *
     * @return string
     */
    public function toSimplifiedString()
    {
        return
            ucfirst($this->street).' '.$this->streetNumber."\n".
            $this->city;
    }

    /**
     * Return the address as an HTML string.
     *
     * @return string
     */
    public function toHtml()
    {
        return
            '<p class="h-adr" translate="no">'."\n".
            '<span class="p-street-address">'.
            ucfirst($this->formatAddressLine($this->parts)).
            '</span><br>'."\n".
            '<span class="p-postal-code">'.$this->postalCode.'</span> '.
            '<span class="p-locality">'.$this->city.'</span>'."\n".
            '</p>';
    }

    /**
     * Return a simplified address as an HTML string.
     *
     * This is similar to what `toHtml()` does except that
     * addresses returned by this method do not include
     * postal code nor the country.
     *
     * @return string
     */
    function toSimplifiedHtml()
    {
        return
            '<p class="h-adr" translate="no">'."\n".
            '<span class="p-street-address">'.ucfirst($this->street).
            ' '.
            $this->streetNumber.'</span><br>'."\n".
            '<span class="p-locality">'.$this->city.'</span>'."\n".
            '</p>';
    }

    /**
     * Convert the address to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return
            ucfirst($this->formatAddressLine($this->parts))."\n".
            $this->parts->postal_code.' '.$this->parts->city;
    }
}

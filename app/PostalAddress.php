<?php

namespace App;

use stdClass;
use DomainException;
use CommerceGuys\Addressing\Model\Address;
use CommerceGuys\Addressing\Formatter\DefaultFormatter;
use CommerceGuys\Addressing\Repository\CountryRepository;
use CommerceGuys\Addressing\Repository\SubdivisionRepository;
use CommerceGuys\Addressing\Repository\AddressFormatRepository;
use Symfony\Component\Validator\Validation as SymfonyValidator;
use CommerceGuys\Addressing\Validator\Constraints\Country as CountryRule;
use CommerceGuys\Addressing\Validator\Constraints\AddressFormat as AddressFormatRule;

class PostalAddress extends ContactDetails
{
    /**
     * The type of contact info stored by the object.
     *
     * @var string
     */
    protected $type = 'postal-address';

    /**
     * The ISO 3166-1 alpha-2 code of the country where the currency is used.
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     *
     * @var string
     */
    protected $countryCode;

    /**
     * The components of the postal address.
     *
     * @var \stdClass
     */
    protected $parts;

    /**
     * Create a new ContactDetails model instance of type ‘postal-address’.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->countryCode = config('radisse.country_code');
    }

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
     * Create a CommerceGuys Address instance from the data of the model.
     *
     * @param  \stdClass|null  $parts
     *
     * @return \CommerceGuys\Addressing\Model\Address
     */
    protected function toAddressObject(stdClass $parts = null)
    {
        // Use the internal data if no argument has been passed.
        $parts = $parts ?? $this->parts;

        $this->validatePresenceOfRequiredAddressParts($parts);

        return (new Address)
            ->withRecipient($parts->recipient)
            ->withAddressLine1($this->formatAddressLine1($parts))
            ->withPostalCode($parts->postal_code)
            ->withLocality($parts->city)
            ->withCountryCode($this->countryCode)
            ->withLocale(config('app.locale'));
    }

    /**
     * Helper method to format an address line from address parts.
     *
     * @param  \stdClass  $parts
     *
     * @return string
     */
    protected function formatAddressLine1(stdClass $parts)
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
     * @param  stdClass|\CommerceGuys\Addressing\Model\Address  $address
     *
     * @return void
     *
     * @throws \DomainException if the postal address is invalid.
     */
    protected function validateAddress($address)
    {
        if ($address instanceof stdClass) {
            $address = $this->toAddressObject($address);
        }

        $validator = SymfonyValidator::createValidator();

        // First, we validate the country code.
        $violations = $validator->validate(
            $address->getCountryCode(),
            new CountryRule
        );

        if ($violations->count()) {
            throw new DomainException($violations->__toString());
        }

        // Second, we validate the rest of the address.
        $violations = $validator->validate($address, new AddressFormatRule);

        if ($violations->count()) {
            throw new DomainException($violations->__toString());
        }
    }

    /**
     * Check if all of the required components of an address are present.
     *
     * @param  \stdClass  $address
     *
     * @return void
     *
     * @throws \DomainException if at least one required component is missing.
     */
    protected function validatePresenceOfRequiredAddressParts(stdClass $address)
    {
        $requiredParts = [
            'recipient',
            'street', 'street_number',
            'postal_code', 'city'
        ];

        foreach ($requiredParts as $part) {
            if (!isset($address->{$part})) {
                throw new DomainException(
                    "Missing [{$part}] component in postal address."
                );
            }
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
            $this->recipient."\n".
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
        $address = $this->toAddressObject();

        return $this->getFormatter($asHtml = true)->format($address);
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
            '<p translate="no">'."\n".
            '<span class="address-line1">'.ucfirst($this->street).
            ' '.
            $this->streetNumber.'</span><br>'."\n".
            '<span class="locality">'.$this->city.'</span>'."\n".
            '</p>';
    }

    /**
     * Convert the address to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        $address = $this->toAddressObject();

        return $this->getFormatter()->format($address);
    }

    /**
     * Get a postal address formatter
     *
     * @return \CommerceGuys\Addressing\Formatter\DefaultFormatter
     */
    protected function getFormatter($asHtml = false)
    {
        return new DefaultFormatter(
            new AddressFormatRepository,
            new CountryRepository,
            new SubdivisionRepository,
            $locale = config('app.locale'),
            $options = [
                'html' => $asHtml,
                'html_tag' => 'p',
                'html_attributes' => ['translate' => 'no'],
            ]
        );
    }
}

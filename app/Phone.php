<?php

namespace App;

use DomainException;
use Propaganistas\LaravelPhone\PhoneNumber;

class Phone extends ContactDetails
{
    /**
     * The type of contact info stored by the object.
     *
     * @var string
     */
    protected $type = 'phone';

    /**
     * The ISO 3166-1 alpha-2 code of the country where the currency is used.
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     *
     * @var string
     */
    protected $countryCode;

    /**
     * The phone number, formatted in international format.
     *
     * @var string
     */
    protected $number;

    /**
     * Create a new ContactDetails model instance of type ‘phone’.
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
     * Create a new instance from a phone number given as a string.
     *
     * @param  string  $number
     *
     * @return self
     *
     * @throws \DomainException if the phone number is invalid.
     */
    public static function fromNumber($number)
    {
        $phone = new self;

        // Calling the magic method allows us to centralize validation
        // and formatting there instead of duplicating code.
        $phone->__set('number', $number);

        return $phone;
    }

    /**
     * Format the phone number in national format.
     *
     * @return string
     */
    public function toNationalFormat()
    {
        return $this->toPhoneObject()->formatNational();
    }

    /**
     * Format the phone number in international format.
     *
     * @return string
     */
    public function toInternationalFormat()
    {
        return $this->toPhoneObject()->formatInternational();
    }

    /**
     * Format the phone number in the E.164 format.
     * @see https://en.wikipedia.org/wiki/E.164
     *
     * @return string
     */
    public function toE164Format()
    {
        return $this->toPhoneObject()->formatE164();
    }

    /**
     * Create a PhoneNumber instance from the data of the model.
     *
     * @param  string|null  $number
     * @param  string|null  $countryCode
     *
     * @return \Propaganistas\LaravelPhone\PhoneNumber
     */
    protected function toPhoneObject($number = null, $countryCode = null)
    {
        return PhoneNumber::make(
            $number ?? $this->number,
            $country_code ?? $this->countryCode
        );
    }

    /**
     * Check if a given phone number is valid.
     *
     * @param  string  $number
     * @param  string  $countryCode
     *
     * @return void
     *
     * @throws \DomainException if the phone number is invalid.
     */
    protected function validatePhoneNumber($number, $countryCode)
    {
        if (validator([$number], ['phone:'.$countryCode])->fails()) {
            throw new DomainException("[{$number}] is an invalid phone number.");
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
            'number' => $this->toE164Format(),
        ];
    }

    /**
     * Get the keys that are specific to this type of contact info.
     *
     * @return array
     */
    protected function getOwnAttributeKeys()
    {
        return ['number'];
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
        if ($name === 'number') {
            return $this->number;
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
        if ($name === 'number') {
            // Ensure the number has a valid syntax.
            $this->validatePhoneNumber($value, $this->countryCode);

            // Format it in international format before storing it internally.
            $this->number = $this->toPhoneObject($value)->formatInternational();
        } else {
            // Fall back on the magic method of the parent.
            parent::__set($name, $value);
        }
    }

    /**
     * Convert the phone number to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toInternationalFormat();
    }
}

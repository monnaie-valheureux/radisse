<?php

namespace App;

use DomainException;
use Email\Parse as EmailParser;

class Email extends ContactDetails
{
    /**
     * The type of contact info stored by the object.
     *
     * @var string
     */
    protected $type = 'email';

    /**
     * The components of the e-mail address.
     *
     * @var array
     */
    protected $parts;

    /**
     * Create a new instance from an e-mail address.
     *
     * @param  string  $address
     *
     * @return self
     *
     * @throws \DomainException if the e-mail address is invalid.
     */
    public static function fromAddress($address)
    {
        $email = new self;

        // We store the components of the address, not the address itself.
        $email->parts = $email->parseEmail($address);

        return $email;
    }

    /**
     * Convert the e-mail to an obfuscated <a> HTML element.
     *
     * @return string
     */
    public function asLink()
    {
        return app('html')->mailto($this->address);
    }

    /**
     * Helper to parse an e-mail address and get its components.
     *
     * @param  string  $address
     *
     * @return array
     *
     * @throws \DomainException if the e-mail address is invalid.
     */
    protected function parseEmail($address)
    {
        $result = EmailParser::getInstance()->parse($address);

        if ($result['success'] === false) {
            throw new DomainException("[{$address}] is an invalid e-mail address.");
        }

        return $result['email_addresses'][0];
    }

    /**
     * Get the key-value pairs of data that are specific to this type of contact info.
     *
     * @return array
     */
    protected function getOwnAttributes()
    {
        return [
            'address' => $this->address,
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
            case 'localPart':
                return $this->parts['local_part'];
            case 'domain':
                return $this->parts['domain'];
            case 'address':
                return $this->parts['local_part'].'@'.$this->parts['domain'];
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
            case 'localPart':
                $this->parts['local_part'] = $value;
                break;
            case 'domain':
                $this->parts['domain'] = $value;
                break;
            case 'address':
                // We store the components of the address, not the address itself.
                $this->parts = $this->parseEmail($value);
                break;
            default:
                // Fall back on the magic method of the parent.
                parent::__set($name, $value);
                break;
        }
    }

    /**
     * Convert the e-mail to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }
}

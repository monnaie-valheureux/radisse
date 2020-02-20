<?php

namespace App;

use DomainException;
use Email\Parse as EmailParser;
use Illuminate\Contracts\Support\Htmlable;

class Email extends ContactDetails implements Htmlable
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
     * Allows the object to be automatically converted to an HTML link
     * when echoed in a Blade template.
     *
     * @return string
     */
    public function toHtml()
    {
        return $this->asLink();
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

                // Super weird fix for PHP 7.4… I really don’t know what’s
                // going on here! This is used to fix a notice of
                // ‘Trying to access array offset on value of type null’
                // which has been introduced since PHP 7.4:
                // https://www.php.net/manual/en/migration74.incompatible.php#migration74.incompatible.core.non-array-access
                if (!isset($this->parts['local_part'])) {
                    $this->parts['local_part'] = '';
                }
                if (!isset($this->parts['domain'])) {
                    $this->parts['domain'] = '';
                }
                // End of fix.

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

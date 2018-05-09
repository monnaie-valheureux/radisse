<?php

namespace App;

class Website extends ContactDetails
{
    /**
     * The type of contact info stored by the object.
     *
     * @var string
     */
    protected $type = 'website';

    /**
     * The URL of the website.
     *
     * @var string
     */
    protected $url;

    /**
     * Create a new instance from a URL.
     *
     * @param  string  $url
     *
     * @return self
     */
    public static function fromUrl($url)
    {
        $site = new self;

        $site->url = $url;

        return $site;
    }

    /**
     * Get the key-value pairs of data that are specific to this type of contact info.
     *
     * @return array
     */
    protected function getOwnAttributes()
    {
        return [
            'url' => $this->url,
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
            case 'url':
                return $this->url;
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
            case 'url':
                $this->url = $value;
                break;
            default:
                // Fall back on the magic method of the parent.
                parent::__set($name, $value);
                break;
        }
    }

    /**
     * Convert the website to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }
}

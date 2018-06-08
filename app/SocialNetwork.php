<?php

namespace App;

use DomainException;

class SocialNetwork extends ContactDetails
{
    /**
     * The type of contact info stored by the object.
     *
     * @var string
     */
    protected $type = 'social-network';

    /**
     * The name of the social network, in lowercase.
     *
     * @var string
     */
    protected $name;

    /**
     * The identifier that is related to the social network.
     *
     * @var string
     */
    protected $handle;

    /**
     * A list of supported networks and, for each, patterns to work with it.
     *
     * @var array
     */
    protected $supportedNetworks = [
        'facebook' => [
            'official_name' => 'Facebook',
            'regex' =>
                '%^

                (?:[a-z-]*\.)?      # An optional subdomain (e.g. `fr-fr.`).

                facebook.com/       # The Facebook domain name itself.

                ([0-9\p{L}.-]+)/*   # The handle we’re looking for.
                                    # It can contain Unicode letters,
                                    # numbers, dots and dashes.

                $%ux',

            'url_format' => 'https://www.facebook.com/:handle:',
        ],
        'twitter' => [
            'official_name' => 'Twitter',
            'regex' => '%^twitter.com/([0-9A-Za-z._-]+)$%',
            'url_format' => 'https://twitter.com/:handle:',
        ],
    ];

    /**
     * Create a new instance from a URL.
     *
     * @param  string  $url
     *
     * @return self
     *
     * @throws \DomainException if no social netwwork can be detected.
     */
    public static function fromUrl($url)
    {
        $network = new self;

        [$network->name, $network->handle] = $network->detectTypeAndHandle($url);

        return $network;
    }

    /**
     * Helper to parse the URL of a social network and extract its handle.
     *
     * @param  string  $url
     *
     * @return array   The first index is the name of the social network,
     *                 in lowercase. The second index is the handle.
     *
     * @throws \DomainException if no social netwwork can be detected.
     */
    protected function detectTypeAndHandle($url)
    {
        // First, decode the URL just in case it came in a URL-encoded form.
        $url = urldecode($url);

        // Then, clean the URL from protocol stuff.
        $url = preg_replace('#https?://|www\.#', '', $url);

        // Finally, look for a supported social network.
        foreach ($this->supportedNetworks as $network => $patterns) {
            if ($handle = $this->findHandle($url, $network)) {
                return [$network, $handle];
            }
        }

        throw new DomainException("Cannot detect social network from [{$url}].");
    }

    /**
     * Try to extract the handle from the URL of a social network.
     *
     * @param  string  $url      The URL to analyze
     * @param  string  $network  The name of the social network, in lowercase
     *
     * @return string|false
     */
    protected function findHandle($url, $network)
    {
        $regex = $this->supportedNetworks[$network]['regex'];
        $matches = [];

        if (preg_match($regex, $url, $matches)) {
            return $matches[1];
        }

        return false;
    }

    /**
     * Build the URL from the network and the handle.
     *
     * @return string
     */
    protected function getUrl()
    {
        $subject = $this->supportedNetworks[$this->name]['url_format'];

        return preg_replace('#:handle:#', $this->handle, $subject);
    }

    /**
     * Get the key-value pairs of data that are specific to this type of contact info.
     *
     * @return array
     */
    protected function getOwnAttributes()
    {
        return [
            'name' => $this->name,
            'handle' => $this->handle,
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
            case 'name':
                return $this->name;
            case 'officialName':
                return $this->supportedNetworks[$this->name]['official_name'];
            case 'handle':
                return $this->handle;
            case 'url':
                return $this->getUrl();
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
            case 'name':
                $this->name = $value;
                break;
            case 'handle':
                $this->handle = $value;
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
        return $this->url;
    }
}

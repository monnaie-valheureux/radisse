<?php

namespace App\Services;

use Exception;
use App\SocialNetwork;
use Illuminate\Support\Str;
use GuzzleHttp\Client as GuzzleClient;

/**
 * A small hacky class that tries to extract opening hours data from Facebook.
 */
class OpeningHoursFacebookExtractor
{
    /**
     * The base URI to use when no complete URL is provided.
     *
     * @var string
     */
    protected $baseUri = 'https://www.facebook.com/pg/';

    /**
     * Try to get opening hours from Facebook for a given target.
     *
     * @param  \App\SocialNetwork|string  $target
     *
     * @return array
     */
    public function extractFor($target)
    {
        $html = $this->getPage($this->getUrlForTarget($target));

        $rawHoursArray = $this->extractHoursArray($html);

        $openingHours = $this->refineHoursArray($rawHoursArray);

        return $openingHours;
    }

    /**
     * Get the URL of a Facebook ‘About’ page for the given target.
     *
     * @param  \App\SocialNetwork|string  $target
     *
     * @return string
     */
    protected function getUrlForTarget($target)
    {
        // The target is a full URL.
        if (
            is_string($target) &&
            Str::startsWith($target, ['http://', 'https://'])
        ) {
            return $target;
        }

        // The target is a Facebook-related instance of SocialNetwork.
        if ($target instanceof SocialNetwork && $target->isFacebook()) {
            return $this->baseUri.$target->handle.'/about';
        }

        // The target is a Facebook handle.
        if (is_string($target)) {
            return $this->baseUri.$target.'/about';
        }

        // If none of the above was true, then just go mad.
        throw new Exception;
    }

    /**
     * Get the contents of a given URL.
     *
     * @param  string  $url
     *
     * @return string
     */
    protected function getPage($url)
    {
        $client = new GuzzleClient([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:67.0) Gecko/20100101 Firefox/67.0',
                'Accept-Language' => 'fr-BE,fr;q=0.8,en-GB;q=0.5,en;q=0.3',
            ],
        ]);

        $response = $client->get($url);

        return $response->getBody()->getContents();
    }

    /**
     * Extract opening hours data from the HTML source of a Facebook page.
     *
     * @param  string  $html
     *
     * @return array
     */
    protected function extractHoursArray($html)
    {
        // We will look for a specific JSON array that is contained in the
        // HTML code.

        // We first look for a piece of text that we know has to be there. We
        // thus get the position of this text inside the HTML source string.
        $mondayLabelPosition = strpos($html, '"label":"lundi');

        // In order to find the beginning of the JSON array, we isolate the part
        // of the HTML that is before the label we found. In this substring, we
        // then look for the last occurrence of another specific piece of text.
        $substringBeforeMondayLabel = substr($html, 0, $mondayLabelPosition);

        $jsonStartPosition = strrpos($substringBeforeMondayLabel, '[{"ctor":');

        // Then, we do the opposite to find the end of the JSON array: we look
        // for the first closing square bracket that comes *after* the label.
        $jsonEndPosition = strpos($html, ']', $offset = $mondayLabelPosition);

        // Now that we have the ‘boundaries’ of the JSON code inside the HTML
        // source string, we calculate the amount of characters of that JSON
        // array in order to extract it.
        $jsonLength = $jsonEndPosition - $jsonStartPosition + 1;

        $jsonCode = substr($html, $jsonStartPosition, $jsonLength);

        // Finally, we decode and return the extracted JSON array.
        return json_decode($jsonCode);
    }

    /**
     * Extract and clean relevant data from a Facebook array of opening hours.
     *
     * @param  array  $rawHoursArray
     *
     * @return array
     */
    protected function refineHoursArray(array $rawHoursArray)
    {
        // The raw array contains 7 objects (one for each day). Inside these
        // objects, only one property is useful: the `label` one.
        // We will extract these properties and build a new, proper array
        // from their contents. This array will contain an array of time
        // ranges for each day, which will be empty for closed days.

        $openingHours = [];

        foreach ($rawHoursArray as $day) {

            $label = $day->label;

            // Each label string follows one these two patterns:
            //
            //   1. A day name followed by one or more ranges of time:
            //
            //      <dayName>: <hourRange>(,<hourRange>)*
            //
            //   2. A day name followed by the string ‘FERMÉ’ (‘CLOSED’):
            //
            //      <dayName>: FERMÉ
            //
            // The day names will be used as keys for the returned array, and
            // ranges of hours will be used as values.


            // We initialize/reset variables.
            $dayName = null;
            $ranges = [];

            // Start by extracting the name of the day.
            $position = strpos($label, ':');
            $dayName = substr($label, 0, $position);
            $dayName = $this->getEnglishDayName($dayName);

            // Discard the day name and keep the rest of the label.
            $rest = trim(substr($label, $position + 1));

            // We then look for ranges of time.
            $rangeStrings = explode(',', $rest);

            foreach ($rangeStrings as $str) {
                $str = trim($str);

                // If this is a closed day, there’s no need to go any further.
                if ($str === 'FERMÉ') {
                    break;
                }

                // Clean the range by removing white spaces and then store it.
                $ranges[] = str_replace(' - ', '-', $str);
            }

            // Finally, store the list of ranges for the current day
            $openingHours[$dayName] = $ranges;
        }

        // The refined array is now complete.
        return $openingHours;
    }

    /**
     * Get the English day name corresponding to a given French day name.
     *
     * @param  string  $frenchDayName
     *
     * @return string
     */
    protected function getEnglishDayName($frenchDayName)
    {
        $dayNames = [
            'lundi'    => 'monday',
            'mardi'    => 'tuesday',
            'mercredi' => 'wednesday',
            'jeudi'    => 'thursday',
            'vendredi' => 'friday',
            'samedi'   => 'saturday',
            'dimanche' => 'sunday',
        ];

        return $dayNames[$frenchDayName];
    }
}

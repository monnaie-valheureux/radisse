<?php

namespace App;

/**
 * Get partners data from a JSON file.
 */
class JsonPartnerLoader
{
    /**
     * Get partners data from a JSON file.
     *
     * @param string  $file  Path to the JSON file to load.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function load($file)
    {
        $data = file_get_contents($file);

        return collect(json_decode($data, $assoc = true));
    }
}

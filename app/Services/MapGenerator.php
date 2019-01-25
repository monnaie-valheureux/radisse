<?php

namespace App\Services;

use Exception;
use App\PostalAddress;
use Illuminate\Support\Str;
use Facades\App\Services\Geocoder;
use App\Exceptions\NonGeolocatable;
use Intervention\Image\Facades\Image;
use Symfony\Component\Process\Process;

class MapGenerator
{
    /**
     * The default set of options of the generator.
     *
     * @var array
     */
    protected $options = [
        'latitude' => 50.647928290006,
        'longitude' => 5.5726012798658,
        'zoom_level' => 18,
        'map_name' => 'ASBL le Val’heureux',
        'map_width' => 486,
        'map_height' => 300,
        'storage_path' => null,
        'draw_marker' => true,
        'marker_image' => null,
        'tile_provider' => null,
    ];

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->options['storage_path'] = storage_path('app/tmp/');
        $this->options['marker_image'] = public_path('storage/map-marker@1x.png');
        $this->options['tile_provider'] = config('radisse.map_tile_provider');
    }

    /**
     * Set the zoom level to generate the map for.
     *
     * @param  int  $zoomLevel
     *
     * @return self
     */
    public function setZoomLevel(int $zoomLevel)
    {
        $this->options['zoom_level'] = $zoomLevel;

        return $this;
    }

    /**
     * Set the name of the map.
     *
     * @param  string  $name
     *
     * @return self
     */
    public function setMapName(string $name)
    {
        $this->options['map_name'] = $name;

        return $this;
    }

    /**
     * Set the width of the generated map.
     *
     * @param  int  $width
     *
     * @return self
     */
    public function setMapWidth(int $width)
    {
        $this->options['map_width'] = $width;

        return $this;
    }

    /**
     * Set the height of the generated map.
     *
     * @param  int  $height
     *
     * @return self
     */
    public function setMapHeight(int $height)
    {
        $this->options['map_height'] = $height;

        return $this;
    }

    /**
     * Get the options of the map generator.
     *
     * @return array
     */
    public function getOptions() : array
    {
        return $this->options;
    }

    /**
     * Generate a map from a postal address, using the defined options.
     *
     * @param  \App\PostalAddress  $address
     *
     * @return string  The path to the generated image.
     */
    public function generateFromPostalAddress(PostalAddress $address)
    {
        $this->setCoordinatesFromAddress($address);

        $this->options['map_name'] = 'postal-address-'.$address->id;

        return $this->generate();
    }

    /**
     * Generate a map using the defined options.
     *
     * @return string  The path to the generated image.
     */
    public function generate()
    {
        $storagePath = $this->options['storage_path'];

        $pathToMap = $storagePath.$this->makeFileName();

        if (!file_exists($storagePath)) {
            mkdir($storagePath);
        }

        // Generate the actual map.
        $this->callMapstatic($pathToMap);

        if ($this->options['draw_marker']) {
            $this->insertMarker($pathToMap);
        }

        return $pathToMap;
    }

    /**
     * Insert a position marker on a given map.
     *
     * @param  string  $pathToMap
     *
     * @return void
     */
    public function insertMarker($pathToMap)
    {
        $unmarkedMap = Image::make($pathToMap);
        $marker = Image::make($this->options['marker_image']);

        $unmarkedMap->insert(
            $source = $marker,
            $position = 'top',
            $offsetX = 0,
            // We position the bottom of the marker
            // at the exact center of the image.
            $offsetY = ($unmarkedMap->height() / 2) - $marker->height()
        )->save();
    }

    /**
     * Generate a file name for the map using the defined options.
     *
     * @return string
     */
    protected function makeFileName()
    {
        return
            Str::slug($this->options['map_name']).'_'.
            $this->options['map_width'].'x'.$this->options['map_height'].
            'z'.$this->options['zoom_level'].'.png';;
    }

    /**
     * Call the mapstatic command to actually generate
     * a map using the defined options.
     *
     * @param  string  $pathToMap
     *
     * @return void
     */
    protected function callMapstatic($pathToMap)
    {
        $command =
            'mapstatic map '.
            $pathToMap.
            ' --zoom='.$this->options['zoom_level'].
            ' --lat='.$this->options['latitude'].
            ' --lng='.$this->options['longitude'].
            ' --width='.$this->options['map_width'].
            ' --height='.$this->options['map_height'].
            ' --provider='.$this->options['tile_provider'];

        $process = new Process($command);

        $process->setTimeout(30)->run();
    }

    /**
     * Use an address to set the latitude and longitude for the map.
     *
     * @param  \App\PostalAddress  $address
     *
     * @return void
     */
    protected function setCoordinatesFromAddress(PostalAddress $address)
    {
        if ($address->isGeolocatable === false) {
            throw NonGeolocatable::markedExplicitly($address);
        }

        if (!$address->hasGeoCoordinates()) {
            $coords = Geocoder::getCoordinates($address->toString());
        }

        $this->options['latitude'] = $coords->latitude ?? $address->latitude;
        $this->options['longitude'] = $coords->longitude ?? $address->longitude;
    }
}

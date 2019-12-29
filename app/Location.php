<?php

namespace App;

use App\Services\MapGenerator;
use App\Exceptions\NonGeolocatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * A location is a place where a partner welcomes its customers. For example, it
 * may be a shop, a restaurant, an office or any other place where the currency
 * will be used and exchanged between the partner and its customers.
 */
class Location extends Model implements HasMedia
{
    use HasPostalAddress;
    use HasPhones;

    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the partner that owns the location.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Get the currency exchange that may be associated with the location.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currencyExchange()
    {
        return $this->hasOne(CurrencyExchange::class);
    }

    /**
     * Check if the location has a currency exchange.
     *
     * This is just some syntactic sugar.
     *
     * @return bool
     */
    public function hasCurrencyExchange()
    {
        return (bool) $this->currencyExchange;
    }

    /**
     * Get the location’s city.
     *
     * This reads the cache column for the city
     * name of the Location’s postal address.
     *
     * @return string
     */
    public function getCityAttribute()
    {
        return $this->city_cache;
    }

    /**
     * Get all of the Location’s phones that are public, or those
     * from the Location’s Partner is there is none.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSuitablePublicPhonesAttribute()
    {
        if ($this->publicPhones->isNotEmpty()) {
            return $this->publicPhones;
        }

        return $this->partner->publicPhones;
    }

    /**
     * Associate or replace a postal address for the location.
     *
     * @param string  $label
     * @param array   $parts
     */
    public function setPostalAddress($label, array $parts)
    {
        $parts = array_merge(['recipient' => $this->name], $parts);

        if (
            $this->postalAddress &&
            $this->postalAddress->label === $label
        ) {
            // An address already exists, so we’ll update it.
            $this->postalAddress->modify($parts)->save();
        } else {
            // Otherwise we create a new address in the database.
            $address = PostalAddress::fromArray($parts)
                        ->withLabel($label)
                        ->makePublic();

            $this->postalAddress()->save($address);
        }
    }

    /**
     * Check if this location got a latitude and a longitude associated with it.
     *
     * @return bool
     */
    public function hasGeoCoordinates()
    {
        return (
            $this->postalAddress !== null &&
            $this->postalAddress->hasGeoCoordinates()
        );
    }

    /**
     * Register media collections for this model.
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('maps')->singleFile();
    }

    /**
     * Generate a static map for the location.
     *
     * @return \Spatie\MediaLibrary\Models\Media  The media object the map is associated to.
     */
    public function generateMap()
    {
        if ($this->hasNoPostalAddress()) {
            throw NonGeolocatable::locationHasNoAddress($this);
        }

        $generator = new MapGenerator;

        if ($this->hasCurrencyExchange()) {
            $generator->useCurrencyExchangeMarker();
        }

        $pathToMap = $generator->generateFromPostalAddress($this->postalAddress);

        return $this->addMedia($pathToMap)->toMediaCollection('maps');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * A location is a place where a partner welcomes its customers. For example, it
 * may be a shop, a restaurant, an office or any other place were the currency
 * will be used and exchanged between the partner and its customers.
 */
class Location extends Model
{
    use HasPostalAddress;
    use HasPhones;

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
}

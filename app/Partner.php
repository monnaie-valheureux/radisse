<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * A partner is a person or organization that uses the local currency.
 */
class Partner extends Model
{
    use HasContactDetails;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'joined_on',
        'left_on',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // When a partner is created, we automatically
        // generate a slug based on its name.
        static::creating(function (self $partner) {
            if (is_null($partner->slug)) {
                $partner->slug = Str::slug($partner->name);
            }
        });

        // Add a default global scope to all select queries on the model.
        // This will exclude former partners, who left the network of
        // the currency, because most of the time we won’t want them.
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->whereNull('left_on');
        });

        // Add a default global scope to all select queries on the model.
        // This will exclude nonvalidated partners, who have not been
        // accepted (yet) into the network.
        static::addGlobalScope('validated', function (Builder $builder) {
            $builder->whereNotNull('validated_at');
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        // Every time a route explicitly or implicitly expects a partner
        // in one of its segments, it will look for this partner by
        // using its slug instead of the usual primary key.
        //
        // This means that if there is a route like 'foo/{partner}', the
        // partner placeholder will be filled with the slug, not the ID.
        return 'slug';
    }

    /**
     * Get the locations of the partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Get the person(s) who represent the partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representatives()
    {
        return $this->hasMany(PartnerRepresentative::class);
    }

    /**
     * Return the list of cities from the address(es) of the partner’s locations.
     *
     * Cities are sorted in alphabetical order.
     *
     * @return string|null
     */
    public function locationCities()
    {
        $cities = [];

        // Loop on all of the locations of the partner
        // and get the cities they’re in.
        foreach ($this->locations as $location) {

            if (!$location->postalAddress) {
                continue;
            }

            $cities[] = $location->postalAddress->city;
        }

        // Remove duplicates in case there are multiple
        // locations in the same city.
        $cities = array_unique($cities);

        // Then, sort the cities in alphabetical order.
        sort($cities, SORT_LOCALE_STRING);

        return $cities ? implode(', ', $cities) : null;
    }
}

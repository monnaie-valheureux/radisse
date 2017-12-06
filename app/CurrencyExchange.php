<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * A currency exchange is a place where people can get bills of the
 * local currency. It is located at one location of a partner.
 */
class CurrencyExchange extends Model
{
    /**
     * Get the location where the currency exchange is located.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the postal address of the currency exchange’s location.
     *
     * This method is basically a shortcut.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function postalAddress()
    {
        return $this->location->postalAddress();
    }
}

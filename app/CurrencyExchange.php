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
}

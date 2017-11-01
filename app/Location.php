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
}

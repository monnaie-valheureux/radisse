<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A currency exchange is a place where people can get bills of the
 * local currency. It is located at one location of a partner.
 */
class CurrencyExchange extends Model
{
    use SoftDeletes;

    /**
     * The name of the ‘deleted at’ column.
     *
     * @var string
     */
    const DELETED_AT = 'ended_at';

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

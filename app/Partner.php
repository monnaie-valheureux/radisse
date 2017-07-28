<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * A Partner is a person or organization that uses the local currency.
 */
class Partner extends Model
{
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
        self::creating(function (self $partner) {
            $partner->slug = Str::slug($partner->name);
        });
    }
}

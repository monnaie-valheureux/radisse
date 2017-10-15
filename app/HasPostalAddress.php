<?php

namespace App;

/**
 * Allows to associate a postal address with a model.
 */
trait HasPostalAddress
{
    /**
     * Get the model’s postal addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function postalAddress()
    {
        return $this->morphOne(PostalAddress::class, 'contactable')
            ->where('type', 'postal-address');
    }
}

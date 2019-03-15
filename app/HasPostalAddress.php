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

    /**
     * Check if the model has a postal address associated with it.
     *
     * @return bool
     */
    public function hasPostalAddress()
    {
        return $this->postalAddress instanceof PostalAddress;
    }

    /**
     * Check that the model has no postal address associated with it.
     *
     * @return bool
     */
    public function hasNoPostalAddress()
    {
        return !$this->hasPostalAddress();
    }
}

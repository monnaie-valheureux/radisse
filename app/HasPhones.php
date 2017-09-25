<?php

namespace App;

/**
 * Allows to associate one or more phone numbers with a model.
 */
trait HasPhones
{
    /**
     * Get all of the model’s phones.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function phones()
    {
        return $this->morphMany(Phone::class, 'contactable')
            ->where('type', 'phone');
    }
}

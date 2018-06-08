<?php

namespace App;

/**
 * Allows to associate one or more websites with a model.
 */
trait HasWebsites
{
    /**
     * Get all of the model’s websites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function websites()
    {
        return $this->morphMany(Website::class, 'contactable')
            ->where('type', 'website');
    }
}

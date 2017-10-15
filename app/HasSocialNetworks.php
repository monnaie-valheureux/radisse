<?php

namespace App;

/**
 * Allows to associate one or more social networks with a model.
 */
trait HasSocialNetworks
{
    /**
     * Get all of the model’s social networks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function socialNetworks()
    {
        return $this->morphMany(SocialNetwork::class, 'contactable')
            ->where('type', 'social-network');
    }
}

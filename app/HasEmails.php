<?php

namespace App;

/**
 * Allows to associate one or more e-mail addresses with a model.
 */
trait HasEmails
{
    /**
     * Get all of the model’s emails.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function emails()
    {
        return $this->morphMany(Email::class, 'contactable')
            ->where('type', 'email');
    }
}

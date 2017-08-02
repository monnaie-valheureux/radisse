<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * A representative is a person who is officially acting in the name of a
 * partner. This person is the one who communicates with the organization
 * managing the currency project.
 */
class PartnerRepresentative extends Model
{
    /**
     * Get the partner that this person represents.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Check if the representative has an e-mail address.
     *
     * @return bool
     */
    public function hasEmail()
    {
        return !is_null($this->email);
    }
}

<?php

namespace App;

use DomainException;
use Illuminate\Database\Eloquent\Model;

/**
 * A representative is a person who is officially acting in the name of a
 * partner. This person is the one who communicates with the organization
 * managing the currency project.
 */
class PartnerRepresentative extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // When a representative is created, if an e-mail address has
        // been provided, we check that it has a valid syntax.
        self::creating(function (self $representative) {
            if (
                $representative->hasEmail() &&
                filter_var($representative->email, FILTER_VALIDATE_EMAIL) === false
            ) {
                throw new DomainException(
                    "[{$representative->email}] is an invalid e-mail address"
                );
            }
        });
    }

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

    /**
     * Check if the representative has a phone number.
     *
     * @return bool
     */
    public function hasPhone()
    {
        return !is_null($this->phone);
    }
}

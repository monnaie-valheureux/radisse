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
    use HasEmails;
    use HasPhones;

    /**
     * Set the partner representative’s email.
     *
     * @param  string  $email
     * @return void
     */
    public function setEmailAttribute($email)
    {
        if (!is_null($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new DomainException("[{$email}] is an invalid e-mail address.");
        }

        $this->attributes['email'] = $email;
    }

    /**
     * Set the partner representative’s phone number.
     *
     * @param  string  $phone
     * @return void
     */
    public function setPhoneAttribute($phone)
    {
        // If a phone number has been provided, we check if it is valid.
        // If it is, we then format it in the E.164 format.
        // @see https://en.wikipedia.org/wiki/E.164
        if (!is_null($phone)) {

            if (validator([$phone], ['phone:BE'])->fails()) {
                throw new DomainException("[{$phone}] is an invalid phone number.");
            }

            // The number seems valid. Format it in a standard way.
            $phone = phone($phone, 'BE')->formatE164();
        }

        $this->attributes['phone'] = $phone;
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

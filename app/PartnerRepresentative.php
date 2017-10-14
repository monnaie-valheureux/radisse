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
     * Associate an email address with the partner representative.
     *
     * @param string  $address
     * @param bool    $isPublic
     */
    public function addEmail($address, $isPublic = false)
    {
        $email = Email::fromAddress($address);
        $email->isPublic = (bool) $isPublic;

        $this->emails()->save($email);
    }

    /**
     * Associate a public email address with the partner representative.
     *
     * @param string  $address
     */
    public function addPublicEmail($address)
    {
        $this->addEmail($address, $isPublic = true);
    }

    /**
     * Associate a phone number with the partner representative.
     *
     * @param string  $number
     * @param bool    $isPublic
     */
    public function addPhone($number, $isPublic = false)
    {
        $phone = Phone::fromNumber($number);
        $phone->isPublic = (bool) $isPublic;

        $this->phones()->save($phone);
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
        return $this->emails->isNotEmpty();
    }

    /**
     * Check if the representative has a phone number.
     *
     * @return bool
     */
    public function hasPhone()
    {
        return $this->phones->isNotEmpty();
    }
}

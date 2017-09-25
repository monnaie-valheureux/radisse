<?php

namespace App;

/**
 * Allows to associate all types of contact details with a model.
 */
trait HasContactDetails
{
    use HasPostalAddress;
    use HasPhones;
    use HasEmails;
    use HasSocialNetworks;
}

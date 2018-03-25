<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you remain free to modify this option if you wish.
    |
    | Supported: "bcrypt", "argon"
    |
    */

    'driver' => 'bcrypt',

    /*
    |--------------------------------------------------------------------------
    | Default Bcrypt Cost Factor
    |--------------------------------------------------------------------------
    |
    | This option controls the default cost factor that has to be used when
    | hashing a password with the Bcrypt algorithm. The greater the cost,
    | the more time will be needed to hash, thus increasing security.
    */

    'bcrypt_cost' => 12,

];

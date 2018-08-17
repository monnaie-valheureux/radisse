<?php

use Illuminate\Support\Str;
use Illuminate\Routing\Router;

/**
 * Check if a string looks like a Bcrypt hash.
 *
 * @param  string  $str
 * @return bool
 */
Str::macro('isBcryptHash', function ($str) {
   return (bool) preg_match(
        '%^
        \$2y\$              # The version of the algorithm
        [0-9]{2}            # The cost factor
        \$                  # A litteral `$`, acting as a delimiter
        [0-9A-Za-z./]{53}   # The salt followed by the encrypted output
        $%x',
        $str
    );
});

/**
 * Check if the current route points to an admin page.
 *
 * @return bool
 */
Router::macro('isAdmin', function () {
   return request()->is('gestion', 'gestion/*');
});

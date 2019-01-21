<?php

namespace App;

use Spatie\MediaLibrary\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
    /**
     * The table associated with the model.
     *
     * We extend the base model in order to
     * assign a custom table name to it.
     *
     * @var string
     */
    protected $table = 'vendor_media';
}

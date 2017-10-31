<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDetailsTable extends Migration
{
    /**
     * Create the table of contact details.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {

            // Primary key.
            // An unsigned integer with autoincrement.
            $table->increments('id');

            // Combined foreign key for a polymorphic relationship.
            // An unsigned integer combined with a string.
            $table->morphs('contactable');

            // The type of contact info that is stored.
            $table->string('type');

            // The actual content of the contact info.
            $table->json('data');

            // Timestamps telling when the table row was created
            // and when it was modified for the last time.
            $table->timestamps();

            // Since most queries on this table should be filtered to get a
            // specific type of contact info (using the `type` column) we
            // add a composite index to group it with the morph columns.
            $table->index(['contactable_id', 'contactable_type', 'type']);
        });
    }

    /**
     * Drop the table of contact details.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_details');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Create the table of partners.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {

            // Primary key.
            // An unsigned integer with autoincrement.
            $table->increments('id');

            // The name of the partner.
            $table->string('name');

            // The name of the partner, but maybe in a modified form that will
            // make it easier for people to find it in an alphabetical list.
            // Example : 'Du côté de chez Poje' → 'Poje (du côté de chez)'
            $table->string('name_sort')->nullable();

            // The slug is a simplified version of the name that is
            // both people-friendly and computer-friendly, for use
            // in places such as URLs or filenames.
            $table->string('slug');

            // The type of business (ASBL, SPRL, indépendant en
            // personne physique, etc.)
            $table->string('business_type')->nullable();

            // Timestamps telling when the table row was created
            // and when it was modified for the last time.
            $table->timestamps();
        });
    }

    /**
     * Drop the table of partners.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}

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

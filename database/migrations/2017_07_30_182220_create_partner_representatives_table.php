<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerRepresentativesTable extends Migration
{
    /**
     * Create the table of partners.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_representatives', function (Blueprint $table) {

            // Primary key.
            // An unsigned integer with autoincrement.
            $table->increments('id');

            // Foreign key.
            // This references the partner represented by the person.
            $table->unsignedInteger('partner_id');
            $table->foreign('partner_id')->references('id')->on('partners');

            $table->string('given_name')->nullable();
            $table->string('surname')->nullable();

            // The role or position that the person fills for the partner.
            $table->string('role')->nullable();

            // An optional e-mail address the person may be contacted at.
            $table->string('email')->nullable();

            // An optional phone number, in international format.
            $table->string('phone')->nullable();

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
        Schema::dropIfExists('partner_representatives');
    }
}

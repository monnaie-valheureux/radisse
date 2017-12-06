<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyExchangesTable extends Migration
{
    /**
     * Create the table of currency exchanges.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_exchanges', function (Blueprint $table) {

            // Primary key.
            // An unsigned integer with autoincrement.
            $table->increments('id');

            // Foreign key.
            // This references the location where the currency exchange is.
            $table->unsignedInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');

            // Timestamps telling when the table row was created
            // and when it was modified for the last time.
            $table->timestamps();
        });
    }

    /**
     * Drop the table of currency exchanges.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_exchanges');
    }
}

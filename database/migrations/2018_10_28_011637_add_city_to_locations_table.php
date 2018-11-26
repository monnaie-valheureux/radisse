<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the `locations` table to add an optional string column
        // that will be used to cache the city name of the postal
        // address that might be related to the location.
        Schema::table('locations', function (Blueprint $table) {
            $table->string('city_cache')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify the `locations` table to remove the column.
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('city_cache');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsIncognitoToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the `partners` table to add a boolean
        // field saying if a partner is ‘incognito’.
        Schema::table('partners', function (Blueprint $table) {
            $table->boolean('is_incognito')
                  ->after('business_type')
                  ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify the `partners` table to remove the boolean
        // field saying if a partner is ‘incognito’.
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('is_incognito');
        });
    }
}

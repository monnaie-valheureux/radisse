<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonForLeavingToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the `partners` table to add an optional string
        // field saying why a partner has left the network.
        Schema::table('partners', function (Blueprint $table) {
            $table->string('reason_for_leaving')->after('left_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify the `partners` table to remove the optional string
        // field saying why a partner has left the network.
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('reason_for_leaving');
        });
    }
}

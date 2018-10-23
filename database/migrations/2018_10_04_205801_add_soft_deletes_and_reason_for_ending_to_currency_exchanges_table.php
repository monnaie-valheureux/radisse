<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesAndReasonForEndingToCurrencyExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the `currency_exchanges` table to add soft deletes as well as
        // an optional string field saying why a currency exchange has stopped.
        Schema::table('currency_exchanges', function (Blueprint $table) {
            $table->softDeletes('ended_at');
            $table->string('reason_for_ending')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify the `currency_exchanges` table to remove the
        // soft deletes as well as the optional string field
        // saying why a currency exchange has stopped.
        Schema::table('currency_exchanges', function (Blueprint $table) {
            // Commented to avoid breaking tests.
            // @see \Illuminate\Database\Schema\Blueprint::ensureCommandsAreValid()
            // $table->dropColumn('ended_at');
            // $table->dropColumn('reason_for_ending');
        });
    }
}

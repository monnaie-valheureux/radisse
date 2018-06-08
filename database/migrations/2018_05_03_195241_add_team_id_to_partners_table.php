<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamIdToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the `partners` table to add a
        // foreign key referencing a team.
        Schema::table('partners', function (Blueprint $table) {

            // Foreign key.
            // This references the team that ‘owns’ this partner.
            // This adds the column itself…
            $table->unsignedInteger('team_id')
                  ->after('id')
                  ->nullable();

            // …and this adds the index.
            $table->foreign('team_id')
                  ->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify the `partners` table to remove the
        // nullable foreign key referencing a team.
        Schema::table('partners', function (Blueprint $table) {

            // It’s necessary to drop the index *before* deleting the column.
            $table->dropForeign('partners_team_id_foreign')
                  ->dropColumn('team_id');
        });
    }
}

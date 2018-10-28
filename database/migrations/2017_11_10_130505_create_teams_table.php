<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Create the table of teams.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {

            // Primary key.
            // An unsigned integer with autoincrement.
            $table->increments('id');

            // The name of the team.
            $table->string('name')->unique();

            // Timestamps telling when the table row was created
            // and when it was modified for the last time.
            $table->timestamps();
        });

        // Modify the `team_members` table to add
        // a foreign key referencing a team.
        Schema::table('team_members', function (Blueprint $table) {

            // Foreign key.
            // This references the team that the person is a member of.
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Drop the table of teams.
     *
     * @return void
     */
    public function down()
    {
        // Modify the `team_members` table to remove
        // the foreign key referencing a team.
        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('team_members', function (Blueprint $table) {
                $table->dropForeign('team_members_team_id_foreign');
            });
        }

        // It’s necessary to drop the table only *after* all indexes pointing
        // to it have been removed, otherwise the whole thing crashes because
        // it’s not possible to remove these indexes.
        Schema::dropIfExists('teams');
    }
}

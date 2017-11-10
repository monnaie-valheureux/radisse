<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamMembersTable extends Migration
{
    /**
     * Create the table of team members.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members', function (Blueprint $table) {

            // Primary key.
            // An unsigned integer with autoincrement.
            $table->increments('id');

            // Foreign key.
            // This references the team that the person is a member of.
            // Note: this just adds the column. The foreign constraint itself
            //       is added via the migration for the `teams` table.
            $table->unsignedInteger('team_id');

            // These two fields allow to store the identity of the person.
            $table->string('given_name');
            $table->string('surname');

            // The e-mail address of the person is used as
            // a login in order to access the application.
            $table->string('email')->unique();

            // This stores the hashed (with Bcrypt) password of the person.
            $table->string('password');

            // Timestamps telling when the table row was created
            // and when it was modified for the last time.
            $table->timestamps();
        });
    }

    /**
     * Drop the table of team members.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_members');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatorTeamMemberIdToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the `partners` table to add a foreign key referencing
        // the team member who created the partner.
        Schema::table('partners', function (Blueprint $table) {

            // Optional foreign key.
            // This references the team member who created this partner.
            // This adds the column itself…
            $table->unsignedInteger('creator_team_member_id')
                  ->after('endorser_team_member_id')
                  ->nullable();

            // …and this adds the index.
            $table->foreign('creator_team_member_id')
                  ->references('id')->on('team_members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify the `partners` table to remove the foreign key
        // referencing the team member who created the partner.
        Schema::table('partners', function (Blueprint $table) {

            // It’s necessary to drop the index *before* deleting the column.
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign('partners_creator_team_member_id_foreign');
            }

            $table->dropColumn('team_id');
        });
    }
}

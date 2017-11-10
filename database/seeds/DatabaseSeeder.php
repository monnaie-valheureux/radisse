<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PartnersSeeder::class);

        // Add some teams.
        $liegeTeam = factory(\App\Team::class)->create(['name' => 'Liège']);

        factory(\App\Team::class)->create(['name' => 'Herve']);
        factory(\App\Team::class)->create(['name' => 'Huy-Hesbaye-Condroz']);
        factory(\App\Team::class)->create(['name' => 'Ourthe-Amblève']);
        factory(\App\Team::class)->create(['name' => 'Verviers']);

        // Add a test team member.
        factory(\App\TeamMember::class)->create([
            'given_name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.org',
            // Bcrypt hash of the string ‘secret’, with a cost factor of 12.
            'password' => '$2y$12$GF73JIWsj7sQK0q35oA1d.R/BSIozS1e7hNspJJolUj0/gYZb9jL2',
            'team_id' => $liegeTeam->id,
        ]);
    }
}

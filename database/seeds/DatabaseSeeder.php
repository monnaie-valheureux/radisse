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
        $teamMember = factory(\App\TeamMember::class)->create([
            'given_name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.org',
            // Bcrypt hash of the string ‘secret’, with a cost factor of 12.
            'password' => '$2y$12$GF73JIWsj7sQK0q35oA1d.R/BSIozS1e7hNspJJolUj0/gYZb9jL2',
            'team_id' => $liegeTeam->id,
        ]);

        // Add a few other test team members.
        for ($i = 0; $i < 5; $i++) {

            $teamId = ($i < 3) ? $liegeTeam->id : 2;

            factory(\App\TeamMember::class)->create([
                'team_id' => $teamId,
                'password' => $teamMember->password,
            ]);
        }


        // Reset cached roles and permissions.
        app()['cache']->forget('spatie.permission.cache');

        // Create permissions and assign all of them to the test team member.
        $permissions = [
            'add partners',
            'endorse partners',
            'add team members',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        // Give this permission to the test team member.
        $teamMember->givePermissionTo($permissions);
    }
}

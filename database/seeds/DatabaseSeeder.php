<?php

use App\Settings;
use App\User;
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
        // $this->call(UsersTableSeeder::class);
        factory(User::class)->create([
            'name'     => 'Super Admin',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'admin'    => true,
        ]);

        Settings::create();

        $this->call(TicketTypeSeeder::class);

        /*$teams = factory(Team::class,4)->create();
        $teams->each(function($team){
            $team->memberships()->create([
                "user_id" => factory(User::class)->create()->id
            ]);
            $team->tickets()->createMany( factory(Ticket::class,4)->make()->toArray() );
        });

        factory(Ticket::class)->create();
        */
    }
}

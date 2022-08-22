<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(MemberInvitationSeeder::class);

        $this->call(RoleSeeder::class); //Uso de spatie-permission
        $this->call(UserSeeder::class); //Uso de spatie-permission
    }
}

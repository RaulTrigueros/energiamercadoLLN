<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Seeds\RoleSeeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'=>2,
            'usuario'=>'administrador', 
            'password' => bcrypt('devspt2021'), 
            'condicion'=> 1,
            'role_id'=>1
        ])->assignRole('Admin');
     
      //  User::factory(9)->create();
    }
}

<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class UsersTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{

    $user = User::create([
        'name' => "User1",
        'email' => "User1_Dap@gmail.com ",
        'password' => bcrypt('User1_Dap'),
    ]);
    $user->attachRole('user');

    $user = User::create([
        'name' => "User2",
        'email' => "User2_Dap@gmail.com ",
        'password' => bcrypt('User2_Dap'),
    ]);
    $user->attachRole('user');

    $user = User::create([
        'name' => "Admin",
        'email' => "Admin_Dap@gmail.com ",
        'password' => bcrypt('Admin_Dap'),
    ]);
    $user->attachRole('administrator');

}
}

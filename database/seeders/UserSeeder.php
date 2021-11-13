<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::count()) {
            $users = [
                ['name' => 'super user', 'password' => bcrypt('123456'), 'mobile' => '09991321172', 'email' => 'super@example.com', 'role_id' => 2],

                ['name' => 'admin', 'password' => bcrypt('123456'), 'mobile' => '09991321122', 'email' => 'admin1@example.com', 'role_id' => 1],
                ['name' => 'admin', 'password' => bcrypt('123456'), 'mobile' => '09991321182', 'email' => 'admin2@example.com', 'role_id' => 1],

                ['name' => 'ماهان', 'password' => bcrypt('123456'), 'mobile' => '09991321142', 'email' => 'mahan@example.com', 'role_id' => 4],
                ['name' => 'سیر وسفر', 'password' => bcrypt('123456'), 'mobile' => '09991321142', 'email' => 'seyr@example.com', 'role_id' => 4],
                ['name' => 'لوان', 'password' => bcrypt('123456'), 'mobile' => '09991321142', 'email' => 'lavan@example.com', 'role_id' => 4],
                ['name' => 'همسفر', 'password' => bcrypt('123456'), 'mobile' => '09991321142', 'email' => 'hamsafar@example.com', 'role_id' => 4],

                ['name' => 'reza', 'password' => bcrypt('123456'), 'mobile' => '09991321172', 'email' => 'reza@example.com', 'role_id' => 3],
                ['name' => 'amin', 'password' => bcrypt('123456'), 'mobile' => '09991321172', 'email' => 'amin@example.com', 'role_id' => 3],
                ['name' => 'shadi ', 'password' => bcrypt('123456'), 'mobile' => '09991321172', 'email' => 'shadi@example.com', 'role_id' => 3],


            ];
            foreach ($users as $user) {
                User::create($user);
            };
        }
    }
}

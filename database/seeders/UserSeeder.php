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
                ['name' => 'ali', 'password' => bcrypt('123456'), 'mobile' => '09991321122', 'email' => 'ali@example.com', 'role_id' => 1],
                ['name' => 'leyla', 'password' => bcrypt('123456'), 'mobile' => '09991321172', 'email' => 'leyla@example.com', 'role_id' => 2],
                ['name' => 'shadi', 'password' => bcrypt('123456'), 'mobile' => '09991321182', 'email' => 'shadi@example.com', 'role_id' => 3],
                ['name' => 'laleh', 'password' => bcrypt('123456'), 'mobile' => '09991321142', 'email' => 'laleh@example.com', 'role_id' => 4],
            ];
            foreach ($users as $user) {
                User::create($user);
            };
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'admin',],
            ['name' => 'superuser',],
            ['name' => 'normaluser',],
            ['name' => 'company'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        };
    }
}

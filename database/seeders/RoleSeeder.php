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
        if(! Role::count()){
        $roles = [
            ['id' => 1,'name' => 'admin',],
            ['id' => 2,'name' => 'superuser',],
            ['id' => 3,'name' => 'normaluser',],
            ['id' => 4,'name' => 'company'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        };
    }
    }
}

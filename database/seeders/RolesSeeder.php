<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin', 'description' =>  'Admin Role'],
            ['name' => 'Manager', 'description' =>  'Manager Role'],
            ['name' => 'User', 'description' =>  'User Role'],
            ['name' => 'Client', 'description' =>  'Client Role'],
            ['name' => 'Employee', 'description' =>  'Employee Role'],
            ['name' => 'Staff', 'description' =>  'Staff Role'],
        ];
        foreach($roles as $data)
        {
            Role::create([
               'name' => $data['name'],
               'description' => $data['description']
            ]);
        }
    }
}

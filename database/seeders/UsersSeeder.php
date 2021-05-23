<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
//use App\Models\Role;

class UsersSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        User::truncate();
        $users = [
            ['name' => 'Admin', 'email' =>  'admin@example.com'],
            ['name' => 'Manager', 'email' =>  'manager@example.com'],
            ['name' => 'User', 'email' =>  'user@example.com'],
            ['name' => 'Seller', 'email' =>  'seller@example.com'],
            
            
        ];
        foreach($users as $data)
        {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'avatar' => env('APP_URL', 'http://webmall').'/img/avatars/default.svg',
                'password' => Hash::make('password')
                ]);
                $userDetails = UserDetail::create(['user_id' => $user->id]);
                $user->roles()->attach($user);
                
            }
        }
    }
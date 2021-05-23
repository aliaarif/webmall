<?php

namespace Database\Seeders;

use App\Models\Api;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApisSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Api::truncate();
        $apis = [
            ['url' => '/auth/token', 'name' => 'Authentication - TOKEN_GENERATE', 'method' => 'POST'],
            ['url' => '/auth/invalidate-token', 'name' => 'Authentication -INVALIDATE_TOKEN',  'method' => 'POST'],
            ['url' => '/auth/keep-alive', 'name' => 'Authentication - GENERATE_NEW_TOKEN', 'method' => 'POST'],
            ['url' => '/checkout/:id', 'name' => 'WEBMALL - PAYMENT_SUCCESS', 'method' => 'POST']
            
        ];
        foreach($apis as $data)
        {
            Api::create([
                'url' => $data['url'],
                'name' => $data['name'],
                'method' => $data['method']
                ]);
            }
        }
    }
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::truncate();
        $activities = [
            
            //-------Activity for Webmall Frontend-----------//
            ['code' => 'LIST PRODUCTS','description' => 'User - Show products list page','module_name' => 'Webmall Product Listing'],
            //-------END Activity for Webmall Frontend-----------//


        ];

        foreach($activities as $data)
        {
            Activity::create([
               'code' => $data['code'],
               'description' => $data['description'],
               'module_name' =>$data['module_name']
            ]);
        }
    }
}

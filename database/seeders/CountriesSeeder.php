<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CountriesSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $country1 = Country::create([
            'name' => 'India',
            'sortname' => 'IN',
            'phonecode' => 91
            ]); 
            
            for($i = 1; $i <= 2; $i++)
            {
                $state1 = State::create([
                    'country_id' => $country1->id,
                    'name' => 'India State Name '.$i,
                    ]);
                }
                
                
                $country2 =  Country::create([
                    'name' => 'pakistan',
                    'sortname' => 'PK',
                    'phonecode' => 92
                    ]);
                    
                    for($i = 1; $i <= 2; $i++){
                        $state2 = State::create([
                            'country_id' => $country2->id,
                            'name' => 'India State Name '.$i
                            ]);
                        }
                    }
                }
                
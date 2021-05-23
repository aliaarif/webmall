<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
    * Seed the application's database.
    *
    * @return void
    */
    public function run()
    {
        $this->call([
            CountriesSeeder::class,
            StatesSeeder::class,
            ActivitiesSeeder::class,
            ApisSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,            
            ]);
            
            
            // Product::factory()->count(20)->create();
            // Category::factory()->count(5)->create();
            
            // $categories = Category::all();
            
            // Product::all()->each(function($product) use ($categories) {
                //     $product->categories()->attach(
                    //         $categories->random(2)->pluck('id')->toArray()
                    //     );
                    // });
                    
                }
            }
            
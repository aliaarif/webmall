<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;
use App\Models\LibraryPayment;

class ChargesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        function frand($min, $max, $decimals = 0) {
            $scale = pow(10, $decimals);
            return mt_rand($min * $scale, $max * $scale) / $scale;
          }
          
          


        for($i = 1; $i <= 100; $i++)
        {
            
            $quantity = mt_rand(1, 4);
            $price = frand(380.00, 786.99, 2);
            $total = $quantity * $price;

            $charge = new LibraryPayment;
            $charge->session_id = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(bin2hex(random_bytes(16))), 4));
            $charge->user_id = mt_rand(1, 4);
            $charge->name = 'Universal Facts '.$i;
            $charge->quantity = $quantity;
            $charge->price = $price;
            $charge->total = $total;
            $charge->created_at = now();
            $charge->save();
        }

        //Category::factory()->count(10)->make();
        //Product::factory()->count(100)->make();
    }
}
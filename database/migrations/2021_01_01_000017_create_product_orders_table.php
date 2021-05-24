<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('product_id')->comment('Referring to products table');
            $table->unsignedInteger('order_id')->comment('Referring to orders table');
            $table->unsignedInteger('quantity')->default(1)->comment('Referring to know how many perchaged');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->unsignedInteger('order_id')->nullable()->index('order_id')->comment('Referring to orders');
            $table->unsignedInteger('item_id')->nullable()->comment('To store the item id as per the API document');
            $table->string('item_name')->nullable()->comment('To store the item name');
            $table->string('item_notes')->nullable()->comment('To store item description / notes');
            $table->decimal('item_price')->nullable()->comment('To store the item price');
            $table->integer('item_qty')->nullable()->comment('To store item quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
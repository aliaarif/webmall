<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_address', function (Blueprint $table) {
            $table->id()->comment('primary key');
            $table->unsignedInteger('order_id')->index('fkforaddress')->comment('Referring to orders table ');
            $table->tinyInteger('address_type')->comment('0=shipping ,1=Billing');
            $table->string('add_line1', 100)->nullable()->comment('To store address line 1');
            $table->string('add_line2', 100)->nullable()->comment('To store address line 2');
            $table->string('city', 100)->nullable()->comment('To store city ');
            $table->string('state', 100)->nullable()->comment('To store state');
            $table->integer('zip_code')->nullable()->comment('To store zip code');
            $table->string('country', 100)->comment('To store country name');
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
        Schema::dropIfExists('order_address');
    }
}
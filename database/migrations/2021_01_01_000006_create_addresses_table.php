<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->enum('type', ['home', 'office', 'shop', 'other'])->default('home');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('district');
            $table->string('tehsil');
            $table->string('village');
            $table->string('panchayat');
            $table->string('locality');
            $table->string('neighbourhood');
            $table->string('pin');
            $table->string('flat_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}

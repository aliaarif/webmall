<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('avatar')->nullable();
            $table->string('slug', 50)->unique();
            $table->string('username', 50)->nullable();
            $table->string('mobile', 10)->nullable();
            $table->string('barcode', 50)->nullable();
            $table->string('social', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->unsignedInteger('card_id')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('status')->nullable();
            $table->string('zip_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
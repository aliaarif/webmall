<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_fees', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->string('session_id', 50)->comment('Unique ID to store active session ID ');
            $table->unsignedInteger('user_id')->comment('To store authenticated user id such as Banner/Applicant/User ID');
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
        Schema::dropIfExists('application_fees');
    }
}
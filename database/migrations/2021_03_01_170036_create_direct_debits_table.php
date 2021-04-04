<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_debits', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->unsignedInteger('user_id')->comment('To store authenticated user id such as Banner/Applicant/User ID');
            $table->string('session_id', 50)->comment('Unique ID to store active session ID');
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
        Schema::dropIfExists('direct_debits');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_credits', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->string('session_id', 50)->nullable()->comment('Unique ID to store active session ID');
            $table->unsignedInteger('user_id')->nullable()->comment('To store authenticated user id such as Banner/Applicant/User ID');
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
        Schema::dropIfExists('print_credits');
    }
}
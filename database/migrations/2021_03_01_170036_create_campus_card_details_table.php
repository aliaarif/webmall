<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampusCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campus_card_details', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->string('session_id', 50)->comment('Unique ID to store active session ID ');
            $table->unsignedInteger('user_id')->nullable()->comment('To store authenticated user id such as Banner/Applicant/User ID');
            $table->string('crime_reference', 50)->nullable()->comment('To store crime reference of the applicant\r\n');
            $table->tinyInteger('type_flag')->nullable()->default(0)->comment('To store value of lost = 1 and stolen=2 status\r\n');
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
        Schema::dropIfExists('campus_card_details');
    }
}
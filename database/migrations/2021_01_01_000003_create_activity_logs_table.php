<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            $table->unsignedInteger('activity_id')->index('activity_id')->comment('Referring to activities');
            $table->string('session_id', 100)->index('session_id')->comment('Unique ID to store active session ID');
            $table->string('user_id')->nullable()->comment('To store authenticated user id such as Banner/Applicant/User ID');
            $table->string('ip_address', 50)->nullable()->comment('To store the IP address of client machine');
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
        Schema::dropIfExists('activity_logs');
    }
}
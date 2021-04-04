<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_calls', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            $table->unsignedInteger('activity_id')->nullable()->comment('Referring to the activities');
            $table->unsignedInteger('api_id')->index('id')->comment('Referring to the apis');
            $table->integer('api_status')->comment('To store the API response status code');
            $table->text('api_request')->nullable()->comment('To store the API request details');
            $table->text('api_response')->nullable()->comment('To store the API response details');
            $table->text('api_header')->nullable()->comment('To store the API request header');
            $table->string('ip_address', 50)->nullable()->comment('To store the IP address of client machine');
            $table->timestamps();
            $table->index(['activity_id', 'api_id'], 'activity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_calls');
    }
}
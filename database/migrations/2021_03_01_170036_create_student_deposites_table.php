<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDepositesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_deposites', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->string('session_id', 50)->index('student_deposite_details_transaction_id_foreign')->comment('Unique ID to store active session ID');
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
        Schema::dropIfExists('student_deposites');
    }
}
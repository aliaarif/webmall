<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_payments', function (Blueprint $table) {
            $table->id()->comment('primary key');
            $table->string('session_id', 50)->nullable()->comment('Unique ID to store active session ID');
            $table->unsignedInteger('user_id')->comment('To store authenticated user id such as Banner/Applicant/User ID');
            $table->string('name', 50)->nullable()->comment('Unique ID to store active session ID');
            $table->integer('quantity', )->default(1)->comment('Quantity to store quantity of module');
            $table->decimal('price', 10, 2)->nullable()->comment('Price to store price of module');
            $table->decimal('total', 10, 2)->nullable()->comment('Total to store price of all quantities');
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
        Schema::dropIfExists('library_payments');
    }
}
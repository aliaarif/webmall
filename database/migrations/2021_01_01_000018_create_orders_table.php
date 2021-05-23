<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->comment('primary key');
            $table->unsignedInteger('user_id')->nullable()->comment('To store authenticated user id such as Banner/Applicant/User ID');
            $table->unsignedInteger('transaction_id')->nullable()->comment('To store Elavon transaction ID');
            $table->unsignedInteger('address_id')->nullable()->comment('To store Default Shipping Address ID');
            $table->unsignedInteger('card_id')->nullable()->comment('To store Default Card ID');
            $table->decimal('total', 50)->nullable()->comment('To store the total order amount');
            $table->string('module_name')->nullable()->comment('To store the module name ');
            $table->text('elavon_request')->nullable()->comment('To store the Elavon request params');
            $table->text('elavon_response')->nullable()->comment('To store the Elavon response');
            $table->string('payment_status')->default('Pending')->comment('to store the elevon payment status');
            $table->string('booking_status')->default('Pending')->comment('to store the booking status');
            $table->enum('payment_mode', ['Free', 'Internal Trading', 'Online', 'PDQ', 'Purchase Order'])->nullable()->default('Online')->comment('to store the payment mode');
            $table->string('ip_address', 50)->nullable()->comment('To store the IP address of client machine');
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
        Schema::dropIfExists('orders');
    }
}
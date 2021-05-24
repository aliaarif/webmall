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
            $table->string('order_number');
            $table->string('paypal_orderid')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['pending','processing','completed','decline'])->default('pending');
            $table->float('grand_total');
            $table->integer('item_count');
            $table->boolean('is_paid')->default(false);
            $table->enum('payment_method', ['cash_on_delivery', 'paypal','stripe','card'])->default('cash_on_delivery');
            
            $table->string('shipping_fullname');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_zipcode');
            $table->string('shipping_phone');
            $table->string('notes')->nullable();
            
            $table->string('billing_fullname');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zipcode');
            $table->string('billing_phone');
            $table->string('payment_status')->default('Pending')->comment('to store the elevon payment status');
            $table->string('booking_status')->default('Pending')->comment('to store the booking status');
            $table->enum('payment_mode', ['Free', 'Internal Trading', 'Online', 'PDQ', 'Purchase Order'])->nullable()->default('Online')->comment('to store the payment mode');
            $table->string('ip_address', 50)->nullable()->comment('To store the IP address of client machine');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
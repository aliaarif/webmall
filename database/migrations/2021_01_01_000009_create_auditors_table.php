<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->enum('type', ['Basic', 'Advanced', 'Outstanding'])->default('Basic');
            $table->unsignedInteger('experience');
            $table->unsignedInteger('availability');
            $table->text('skills')->nullable();
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
        Schema::dropIfExists('auditors');
    }
}
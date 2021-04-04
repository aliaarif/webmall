<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->string('from_email', 50)->nullable()->comment('to store from email address');
            $table->string('email_subject', 50)->nullable()->comment('To store for subject of the email');
            $table->string('email_to', 50)->nullable()->comment('to store email to address');
            $table->string('email_cc', 50)->nullable();
            $table->string('email_bcc', 50)->nullable();
            $table->text('email_body')->nullable();
            $table->string('email_template_type')->nullable()->comment('To store for identify the email template type ');
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
        Schema::dropIfExists('email_templates');
    }
}
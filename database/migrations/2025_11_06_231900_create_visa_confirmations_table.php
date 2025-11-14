<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaConfirmationsTable extends Migration
{
    public function up()
    {
        Schema::create('visa_confirmations', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('email');
            $table->string('visa_file');
            $table->string('phone_number');
            $table->text('additional_info')->nullable();

            // Payment
            $table->string('payment_reference')->unique();
            $table->string('payment_status')->default('pending');
            $table->integer('amount')->default(50000);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visa_confirmations');
    }
}

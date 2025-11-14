<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraLuggageRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('extra_luggage_requests', function (Blueprint $table) {
            $table->id();

            $table->string('airline_category'); // local / international
            $table->string('airline');
            $table->string('data_page'); // file path
            $table->string('ticket');    // file path
            $table->string('contact_number');
            $table->string('email');

            // Payment
            $table->string('payment_reference')->unique();
            $table->string('payment_status')->default('pending'); // pending / paid
            $table->integer('amount')->default(25000);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('extra_luggages');
    }
}



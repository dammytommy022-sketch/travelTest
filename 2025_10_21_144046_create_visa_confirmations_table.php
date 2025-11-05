<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_confirmations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('visa_file'); // path to uploaded file
            $table->string('payment_method');
            $table->text('additional_info')->nullable();
            $table->decimal('price', 10, 2)->default(50000);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visa_confirmations');
    }

}

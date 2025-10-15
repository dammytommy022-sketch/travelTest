<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTable extends Migration
{
    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries'); // Adjusted foreign key constraint
            $table->string('visa_type_name')->nullable();
            $table->string('entry')->nullable();
            $table->string('visa_type')->nullable();
            $table->integer('processing_period');
            $table->decimal('visa_fee', 10, 2);
            $table->decimal('biometrics_fee', 10, 2);
            $table->decimal('admin_charge', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('price');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_hires', function (Blueprint $table) {
            $table->id();
            $table->string('car_type');               // saloon | suv | van | bus | luxury
            $table->string('category');               // Economy, Executive, etc.
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->unsignedSmallInteger('passengers')->default(1);
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->date('pickup_date');
            $table->string('pickup_time');
            $table->decimal('amount', 12, 2);
            $table->string('payment_option');         // budpay | seerbit
            $table->string('payment_reference')->unique();
            $table->string('payment_status')->default('pending'); // pending | paid | failed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_hires');
    }
};
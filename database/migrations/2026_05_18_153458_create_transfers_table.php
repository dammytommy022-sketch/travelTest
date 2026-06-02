<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();

            // Vehicle
            $table->string('vehicle_type');           // saloon | suv | van | bus | luxury
            $table->string('vehicle_name');           // human-readable name

            // Route
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->decimal('distance_km', 8, 2);

            // Schedule
            $table->date('pickup_date');
            $table->string('pickup_time');

            // Customer
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->unsignedSmallInteger('passengers')->default(1);
            $table->string('flight_number')->nullable();     // flight or vessel number
            $table->text('special_requests')->nullable();    // child seat, extra luggage etc.

            // Payment
            $table->decimal('amount', 12, 2);
            $table->string('payment_option');                // budpay | seerbit
            $table->string('payment_reference')->unique();
            $table->string('payment_status')->default('pending'); // pending | paid | failed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
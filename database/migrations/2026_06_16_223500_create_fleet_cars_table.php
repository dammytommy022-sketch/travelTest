<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fleet_cars', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');          // car_hire | transfer
            $table->string('vehicle_type');          // saloon, suv, van, bus, luxury
            $table->string('category')->nullable();  // Regular, Standard, Executive (car_hire only)
            $table->string('car_name');              // e.g. Toyota Camry
            $table->string('passengers')->nullable();// e.g. 1 – 3 Passengers
            $table->json('features')->nullable();    // ["Air conditioning", ...]
            $table->json('images')->nullable();      // stored filenames
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fleet_cars');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driver_assignments', function (Blueprint $table) {
            $table->id();

            // Which driver
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');

            // Which booking — only one will be set per row
            $table->unsignedBigInteger('car_hire_id')->nullable();
            $table->unsignedBigInteger('transfer_id')->nullable();

            // Booking type flag for easy querying
            $table->enum('booking_type', ['car_hire', 'transfer']);

            // Car details at time of assignment (driver may use different car each time)
            $table->string('car_model');             // e.g. Toyota Camry
            $table->string('car_colour');            // e.g. Silver
            $table->string('plate_number');          // e.g. LND 123 XY
            // Up to 4 car images stored as JSON array of asset paths
            // e.g. ["assets/img/cars/camry1.jpg", "assets/img/cars/camry2.jpg"]
            $table->json('car_images')->nullable();

            // Admin notes
            $table->text('notes')->nullable();

            // When the assignment email was sent
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('car_hire_id')->references('id')->on('car_hires')->onDelete('cascade');
            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_assignments');
    }
};

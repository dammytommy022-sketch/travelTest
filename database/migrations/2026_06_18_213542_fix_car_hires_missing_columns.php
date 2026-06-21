<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_hires', function (Blueprint $table) {
            // Only add columns that might be missing — wrap each in a hasColumn check
            if (!Schema::hasColumn('car_hires', 'distance_km')) {
                $table->decimal('distance_km', 8, 2)->nullable()->after('pickup_time');
            }
            if (!Schema::hasColumn('car_hires', 'rental_hours')) {
                $table->decimal('rental_hours', 6, 2)->nullable()->after('distance_km');
            }
            if (!Schema::hasColumn('car_hires', 'driver_assigned')) {
                $table->boolean('driver_assigned')->default(false)->after('payment_status');
            }
            if (!Schema::hasColumn('car_hires', 'car_model')) {
                $table->string('car_model', 100)->nullable()->after('category');
            }
        });
    }

    public function down(): void
    {
        Schema::table('car_hires', function (Blueprint $table) {
            $table->dropColumn(['distance_km', 'rental_hours', 'driver_assigned']);
        });
    }
};
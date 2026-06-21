<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add driver_assigned status value to car_hires
        Schema::table('car_hires', function (Blueprint $table) {
            // Add a driver_assigned flag so admin can see at a glance
            $table->boolean('driver_assigned')->default(false)->after('payment_status');
        });

        // Same for transfers
        Schema::table('transfers', function (Blueprint $table) {
            $table->boolean('driver_assigned')->default(false)->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('car_hires', function (Blueprint $table) {
            $table->dropColumn('driver_assigned');
        });

        Schema::table('transfers', function (Blueprint $table) {
            $table->dropColumn('driver_assigned');
        });
    }
};
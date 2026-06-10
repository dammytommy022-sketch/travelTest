<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_hires', function (Blueprint $table) {
            // Stores the specific model chosen e.g. "Toyota Camry", "BMW 7 Series"
            $table->string('car_model')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('car_hires', function (Blueprint $table) {
            $table->dropColumn('car_model');
        });
    }
};
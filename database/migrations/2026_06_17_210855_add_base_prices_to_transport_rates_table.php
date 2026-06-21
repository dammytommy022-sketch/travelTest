<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transport_rates', function (Blueprint $table) {
            $table->unsignedInteger('price_regular')->default(0)->after('vehicle_type');
            $table->unsignedInteger('price_standard')->default(0)->after('price_regular');
            $table->unsignedInteger('price_executive')->default(0)->after('price_standard');
        });

        // Seed the base prices matching the hardcoded values in CarController
        $prices = [
            'saloon' => ['price_regular' => 15000, 'price_standard' => 20000, 'price_executive' => 30000],
            'suv'    => ['price_regular' => 30000, 'price_standard' => 40000, 'price_executive' => 60000],
            'van'    => ['price_regular' => 40000, 'price_standard' => 55000, 'price_executive' => 75000],
            'bus'    => ['price_regular' => 40000, 'price_standard' => 55000, 'price_executive' => 75000],
            'luxury' => ['price_regular' => 40000, 'price_standard' => 55000, 'price_executive' => 75000],
        ];

        foreach ($prices as $type => $vals) {
            DB::table('transport_rates')
                ->where('vehicle_type', $type)
                ->update($vals);
        }
    }

    public function down(): void
    {
        Schema::table('transport_rates', function (Blueprint $table) {
            $table->dropColumn(['price_regular', 'price_standard', 'price_executive']);
        });
    }
};

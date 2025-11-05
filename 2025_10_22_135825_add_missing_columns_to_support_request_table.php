<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToSupportRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('support_requests', function (Blueprint $table) {
        $table->string('airline_category')->nullable();
        $table->string('trip_type')->nullable();
        $table->date('travel_date_oneway')->nullable();
        $table->date('departure_date')->nullable();
        $table->date('return_date')->nullable();
        $table->text('additional_info')->nullable();
    });
}

public function down()
{
    Schema::table('support_requests', function (Blueprint $table) {
        $table->dropColumn([
            'airline_category',
            'trip_type',
            'travel_date_oneway',
            'departure_date',
            'return_date',
            'additional_info',
            'payment_reference'
        ]);
    });
}

}

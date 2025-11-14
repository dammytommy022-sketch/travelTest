<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullNameAndPaymentOptionToExtraLuggageRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extra_luggage_requests', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('id');
            $table->string('payment_option')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extra_luggage_requests', function (Blueprint $table) {
            $table->dropColumn('full_name');
            $table->dropColumn('payment_option');
        });
    }
}

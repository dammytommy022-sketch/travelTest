<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeerbitRefToVisaConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('visa_confirmations', function (Blueprint $table) {
            $table->string('seerbit_ref')->nullable()->after('payment_reference'); 
        });
    }
// ...

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visa_confirmations', function (Blueprint $table) {
            //
        });
    }
}

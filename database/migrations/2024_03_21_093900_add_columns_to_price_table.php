<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPriceTable extends Migration
{
    public function up()
    {
        Schema::table('price', function (Blueprint $table) {
            $table->string('visa_type_name')->nullable();
            $table->integer('processing_period');
            $table->decimal('visa_fee', 10, 2);
            $table->decimal('biometrics_fee', 10, 2);
            $table->decimal('admin_charge', 10, 2);
        });
    }

    public function down()
    {
        Schema::table('price', function (Blueprint $table) {
            $table->dropColumn('visa_type_name');
            $table->dropColumn('processing_period');
            $table->dropColumn('visa_fee');
            $table->dropColumn('biometrics_fee');
            $table->dropColumn('admin_charge');
        });
    }
}

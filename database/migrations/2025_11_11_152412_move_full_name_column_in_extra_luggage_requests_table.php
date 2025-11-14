<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveFullNameColumnInExtraLuggageRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extra_luggage_requests', function (Blueprint $table) {
            $table->string('full_name')->after('id')->change();
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
            $table->string('full_name')->change();
        });
    }
}

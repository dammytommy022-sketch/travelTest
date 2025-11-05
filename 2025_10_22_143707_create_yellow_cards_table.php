<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYellowCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('yellow_cards', function (Blueprint $table) {
        $table->id();
        $table->string('service_type');
        $table->string('full_name');
        $table->string('data_page'); // path to uploaded file
        $table->string('email');
        $table->string('home_address');
        $table->string('phone_number');
        $table->string('delivery_address');
        $table->decimal('price', 10, 2)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yellow_cards');
    }
}

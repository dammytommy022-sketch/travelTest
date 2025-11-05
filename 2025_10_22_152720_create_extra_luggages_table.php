<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extra_luggages', function (Blueprint $table) {
            $table->id();
            $table->string('airline');
            $table->string('email');
            $table->string('contact_number');
            $table->string('ticket'); // file path
            $table->string('data_page'); // file path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extra_luggages');
    }
};


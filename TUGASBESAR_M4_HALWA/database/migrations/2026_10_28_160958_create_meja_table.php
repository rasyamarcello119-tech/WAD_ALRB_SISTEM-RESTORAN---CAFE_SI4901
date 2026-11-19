<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meja', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor', 10);
            $table->integer('kapasitas');
            $table->string('zonasi', 50);
            $table->enum('status', [
                'Available',
                'Occupied',
                'Booked'
            ])->default('Available');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meja');
    }
};


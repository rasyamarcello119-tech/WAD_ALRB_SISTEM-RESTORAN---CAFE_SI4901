<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('menu')) {
            return;
        }

        Schema::create('menu', function (Blueprint $table): void {
            $table->id();
            $table->string('nama', 100);
            $table->string('kategori', 20);
            $table->unsignedInteger('harga');
            $table->text('deskripsi');
            $table->string('alergen', 150)->default('Tanpa alergen utama');
            $table->string('halal', 20);
            $table->string('foto')->default('');
        });
    }

    public function down(): void
    {
        // Tabel menu dapat berasal dari proyek lama. Pertahankan datanya saat rollback.
    }
};

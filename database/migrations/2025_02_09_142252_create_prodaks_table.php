<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prodaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('logo');
            $table->string('gejala');
            $table->string('usia');
            $table->string('kategori');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->text('manfaat');
            $table->string('dosis');
            $table->string('aturan_pakai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodaks');
    }
};

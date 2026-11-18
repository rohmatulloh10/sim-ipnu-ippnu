<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit', 30);
            $table->enum('tingkat', ['PAC', 'Ranting', 'Pengurus Komisariat']);
            $table->timestamps();

            $table->unique(['nama_unit', 'tingkat']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi');
    }
};

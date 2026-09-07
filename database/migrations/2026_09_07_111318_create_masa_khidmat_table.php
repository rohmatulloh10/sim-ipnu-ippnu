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
        Schema::create('masa_khidmat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_periode'); // Contoh: "2020 - 2022" atau "2022 - 2024"
            $table->date('tgl_mulai'); // Tanggal pelantikan / raker
            $table->date('tgl_selesai')->nullable(); // Tanggal demisioner / konferensi
            $table->boolean('is_active')->default(false); // Penanda periode yang sedang berjalan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masa_khidmat');
    }
};

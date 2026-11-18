<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masa_khidmat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_struktur')
                ->constrained('struktur_organisasi')
                ->restrictOnDelete();

            $table->string('nama_periode', 50);
            $table->year('tahun_mulai');
            $table->year('tahun_selesai');
            $table->boolean('is_active')->default(false);

            $table->unsignedBigInteger('id_struktur_aktif')
                ->nullable()
                ->storedAs(
                    "CASE WHEN is_active = 1 THEN id_struktur ELSE NULL END"
                );

            $table->timestamps();

            $table->unique(
                ['id_struktur', 'tahun_mulai', 'tahun_selesai'],
                'uq_masa_khidmat'
            );

            $table->unique('id_struktur_aktif', 'uq_satu_masa_aktif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masa_khidmat');
    }
};

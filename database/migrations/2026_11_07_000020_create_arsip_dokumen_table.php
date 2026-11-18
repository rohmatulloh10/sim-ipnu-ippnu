<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_dokumen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_struktur')
                ->constrained('struktur_organisasi')
                ->restrictOnDelete();

            $table->foreignId('id_masa_khidmat')
                ->nullable()
                ->constrained('masa_khidmat')
                ->nullOnDelete();

            $table->enum('organisasi', ['IPNU', 'IPPNU', 'Bersama']);

            $table->string('nama_dokumen', 200);

            $table->enum('kategori_dokumen', [
                'SK_Pengurus',
                'LPJ',
                'Notulen',
                'SOP',
                'Lainnya'
            ]);

            $table->string('file_dokumen');
            $table->text('keterangan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_dokumen');
    }
};

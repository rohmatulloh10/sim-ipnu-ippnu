<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_proker', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_struktur')
                ->constrained('struktur_organisasi')
                ->cascadeOnDelete();

            $table->string('nama_kategori', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->unique(
                ['id_struktur', 'nama_kategori'],
                'uq_kategori_proker_struktur'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_proker');
    }
};

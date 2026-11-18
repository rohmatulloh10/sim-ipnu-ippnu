<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panitia_proker', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_proker')
                ->constrained('program_kerja')
                ->cascadeOnDelete();

            $table->foreignId('id_penugasan_anggota')
                ->constrained('penugasan_anggota')
                ->restrictOnDelete();

            $table->string('jabatan_panitia', 100)->nullable();
            $table->timestamps();

            $table->unique(
                ['id_proker', 'id_penugasan_anggota'],
                'uq_panitia_proker'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panitia_proker');
    }
};

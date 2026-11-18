<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('realisasi_proker', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_proker')
                ->constrained('program_kerja')
                ->restrictOnDelete();

            $table->date('tgl_pelaksanaan')->nullable();
            $table->string('lokasi')->nullable();
            $table->decimal('realisasi_anggaran', 15, 2)->default(0);
            $table->unsignedInteger('jumlah_peserta')->default(0);
            $table->string('file_lpj')->nullable();
            $table->text('catatan_evaluasi')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisasi_proker');
    }
};

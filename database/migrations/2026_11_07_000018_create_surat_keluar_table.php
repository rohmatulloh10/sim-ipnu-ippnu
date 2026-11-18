<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_masa_khidmat')
                ->constrained('masa_khidmat')
                ->restrictOnDelete();

            $table->foreignId('id_kategori')
                ->nullable()
                ->constrained('kategori_surat')
                ->nullOnDelete();

            $table->foreignId('id_proker')
                ->nullable()
                ->constrained('program_kerja')
                ->nullOnDelete();

            $table->enum('organisasi', ['IPNU', 'IPPNU', 'Bersama']);
            $table->unsignedInteger('no_agenda');
            $table->string('no_surat', 100);
            $table->string('tujuan', 150);
            $table->string('perihal', 255);
            $table->date('tgl_surat');
            $table->string('file_surat')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->unique(['id_masa_khidmat', 'no_agenda']);
            $table->unique(['id_masa_khidmat', 'no_surat']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};

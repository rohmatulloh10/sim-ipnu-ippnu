<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_masa_khidmat')
                ->constrained('masa_khidmat')
                ->restrictOnDelete();

            $table->enum('organisasi', ['IPNU', 'IPPNU', 'Bersama']);
            $table->string('no_surat', 100);
            $table->string('pengirim', 150);
            $table->string('perihal', 255);
            $table->date('tgl_surat')->nullable();
            $table->date('tgl_diterima');
            $table->string('file_surat')->nullable();
            $table->text('catatan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['id_masa_khidmat', 'no_surat'],
                'uq_surat_masuk'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};

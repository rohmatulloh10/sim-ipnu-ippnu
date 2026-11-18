<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disposisi_surat', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_surat_masuk')
                ->constrained('surat_masuk')
                ->cascadeOnDelete();

            $table->foreignId('id_departemen')
                ->nullable()
                ->constrained('departemen')
                ->nullOnDelete();

            $table->text('instruksi');
            $table->date('tgl_disposisi');

            $table->enum('status', [
                'pending',
                'proses',
                'selesai'
            ])->default('pending');

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisi_surat');
    }
};

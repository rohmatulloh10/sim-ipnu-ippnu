<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_kas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_kas')
                ->constrained('kas_rekening')
                ->restrictOnDelete();

            $table->foreignId('id_masa_khidmat')
                ->constrained('masa_khidmat')
                ->restrictOnDelete();

            $table->foreignId('id_kategori')
                ->nullable()
                ->constrained('kategori_keuangan')
                ->nullOnDelete();

            $table->foreignId('id_proker')
                ->nullable()
                ->constrained('program_kerja')
                ->nullOnDelete();

            $table->enum('organisasi', ['IPNU', 'IPPNU', 'Bersama']);

            $table->string('no_transaksi', 50)->unique();

            $table->enum('jenis', ['masuk', 'keluar']);

            $table->decimal('nominal', 15, 2);
            $table->date('tgl_transaksi');
            $table->text('keterangan')->nullable();
            $table->string('file_bukti')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['id_masa_khidmat', 'jenis']);
            $table->index(['id_proker']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_kas');
    }
};

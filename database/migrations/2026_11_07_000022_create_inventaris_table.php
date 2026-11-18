<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_struktur')
                ->constrained('struktur_organisasi')
                ->restrictOnDelete();

            $table->foreignId('id_masa_khidmat')
                ->nullable()
                ->constrained('masa_khidmat')
                ->nullOnDelete();

            $table->foreignId('id_kategori')
                ->nullable()
                ->constrained('kategori_inventaris')
                ->nullOnDelete();

            $table->enum('organisasi', ['IPNU', 'IPPNU', 'Bersama']);
            $table->string('kode_barang', 50);
            $table->string('nama_barang', 150);
            $table->text('merk_spesifikasi')->nullable();
            $table->date('tgl_pengadaan')->nullable();

            $table->enum('sumber_pengadaan', [
                'Pembelian',
                'Hibah_Donasi',
                'Inventaris_Lama'
            ])->default('Pembelian');

            $table->unsignedInteger('jumlah_total')->default(0);
            $table->unsignedInteger('jumlah_baik')->default(0);
            $table->unsignedInteger('jumlah_rusak_ringan')->default(0);
            $table->unsignedInteger('jumlah_rusak_berat')->default(0);

            $table->string('lokasi_penyimpanan', 150)->nullable();
            $table->string('foto_barang')->nullable();
            $table->text('keterangan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->unique(['id_struktur', 'kode_barang']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};

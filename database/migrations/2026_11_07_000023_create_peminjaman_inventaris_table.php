<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman_inventaris', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_inventaris')
                ->constrained('inventaris')
                ->restrictOnDelete();

            $table->foreignId('id_peminjam_penugasan')
                ->nullable()
                ->constrained('penugasan_anggota')
                ->nullOnDelete();

            $table->string('nama_peminjam', 150);
            $table->string('instansi_peminjam', 150)->nullable();

            $table->unsignedInteger('jumlah_pinjam');

            $table->date('tgl_pinjam');
            $table->date('rencana_tgl_kembali');
            $table->date('tgl_realisasi_kembali')->nullable();

            $table->enum('status_peminjaman', [
                'dipinjam',
                'kembali',
                'terlambat',
                'hilang_rusak'
            ])->default('dipinjam');

            $table->string('kondisi_sebelum_pinjam', 100)->nullable();
            $table->string('kondisi_sesudah_kembali', 100)->nullable();
            $table->text('catatan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_inventaris');
    }
};

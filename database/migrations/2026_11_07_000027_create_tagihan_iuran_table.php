
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihan_iuran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_penugasan_anggota')
                ->constrained('penugasan_anggota')
                ->restrictOnDelete();

            $table->enum('jenis_iuran', [
                'rutin',
                'kegiatan'
            ]);

            $table->foreignId('id_proker')
                ->nullable()
                ->constrained('program_kerja')
                ->restrictOnDelete();
            $table->char('bulan_tahun', 7)->nullable();

            $table->decimal('nominal', 15, 2);
            $table->enum('status', [
                'belum_bayar',
                'sebagian',
                'lunas'
            ])->default('belum_bayar');

            $table->date('tanggal_tagihan');

            $table->text('keterangan')->nullable();
            $table->string('kunci_bulan', 7)
                ->nullable()
                ->storedAs(
                    "CASE WHEN jenis_iuran = 'rutin' "
                        . "THEN bulan_tahun ELSE NULL END"
                );
            $table->unsignedBigInteger('kunci_proker')
                ->nullable()
                ->storedAs(
                    "CASE WHEN jenis_iuran = 'kegiatan' "
                        . "THEN id_proker ELSE NULL END"
                );

            $table->timestamps();
            $table->unique(
                ['id_penugasan_anggota', 'kunci_bulan'],
                'uq_tagihan_rutin_per_bulan'
            );
            $table->unique(
                ['id_penugasan_anggota', 'kunci_proker'],
                'uq_tagihan_kegiatan_per_proker'
            );
            $table->index(
                ['jenis_iuran', 'status'],
                'idx_tagihan_jenis_status'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan_iuran');
    }
};

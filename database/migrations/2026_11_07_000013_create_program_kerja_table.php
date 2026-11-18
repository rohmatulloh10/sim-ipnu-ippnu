<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_masa_khidmat')
                ->constrained('masa_khidmat')
                ->restrictOnDelete();

            $table->foreignId('id_kategori')
                ->nullable()
                ->constrained('kategori_proker')
                ->nullOnDelete();

            $table->foreignId('id_rapat_kerja_ditetapkan')
                ->nullable()
                ->constrained('rapat_kerja')
                ->nullOnDelete();

            $table->foreignId('id_rapat_kerja_direvisi')
                ->nullable()
                ->constrained('rapat_kerja')
                ->nullOnDelete();

            $table->foreignId('id_departemen')
                ->nullable()
                ->constrained('departemen')
                ->nullOnDelete();

            $table->foreignId('id_pj_1')
                ->nullable()
                ->constrained('penugasan_anggota')
                ->nullOnDelete();

            $table->foreignId('id_pj_2')
                ->nullable()
                ->constrained('penugasan_anggota')
                ->nullOnDelete();

            $table->enum('sumber_kegiatan', ['raker', 'non_raker'])
                ->default('raker');

            $table->string('nama_proker', 200);
            $table->text('tujuan')->nullable();
            $table->decimal('estimasi_anggaran', 15, 2)->default(0);
            $table->date('rencana_tgl_mulai')->nullable();
            $table->date('rencana_tgl_selesai')->nullable();

            $table->enum('jenis_proker', [
                'rutin',
                'insidental',
                'unggulan'
            ])->nullable();

            $table->enum('status', [
                'perencanaan',
                'disetujui',
                'berjalan',
                'selesai',
                'dibatalkan',
                'dihapus_di_raker'
            ])->default('perencanaan');

            $table->text('alasan_perubahan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['id_masa_khidmat', 'status']);
            $table->index(['id_kategori']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_kerja');
    }
};

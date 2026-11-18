<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_pendanaan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_proker')
                ->constrained('program_kerja')
                ->restrictOnDelete();

            $table->foreignId('id_pihak_pendana')
                ->constrained('pihak_pendana')
                ->restrictOnDelete();

            $table->string('nomor_proposal', 100);
            $table->date('tanggal_pengajuan');

            $table->decimal('nominal_pengajuan', 15, 2);

            $table->enum('status', [
                'draft',
                'diajukan',
                'disetujui',
                'ditolak',
                'selesai'
            ])->default('draft');

            $table->string('file_proposal')->nullable();
            $table->text('keterangan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['id_proker', 'nomor_proposal'],
                'uq_nomor_proposal_proker'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal_pendanaan');
    }
};

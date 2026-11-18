<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerimaan_dana_proker', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_proposal')
                ->constrained('proposal_pendanaan')
                ->restrictOnDelete();

            $table->foreignId('id_transaksi_kas')
                ->unique()
                ->constrained('transaksi_kas')
                ->restrictOnDelete();

            $table->decimal('nominal_diterima', 15, 2);
            $table->dateTime('tanggal_diterima');
            $table->text('keterangan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerimaan_dana_proker');
    }
};

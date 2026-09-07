<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatan')->nullOnDelete();
            $table->date('tgl_transaksi');
            $table->enum('tipe_transaksi', ['pemasukan', 'pengeluaran']);
            $table->string('judul');
            $table->decimal('jumlah', 12, 2);
            $table->text('deskripsi')->nullable();
            $table->string('bukti_img')->nullable();
            $table->foreignId('masa_khidmat_id')->nullable()->constrained('masa_khidmat')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};

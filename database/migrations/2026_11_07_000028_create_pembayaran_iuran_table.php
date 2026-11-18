<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran_iuran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_transaksi_kas')
                ->unique()
                ->constrained('transaksi_kas')
                ->restrictOnDelete();

            $table->dateTime('tanggal_bayar');

            $table->decimal('total_bayar', 15, 2);

            $table->enum('metode_bayar', [
                'tunai',
                'transfer',
                'lainnya'
            ]);

            $table->text('keterangan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_iuran');
    }
};

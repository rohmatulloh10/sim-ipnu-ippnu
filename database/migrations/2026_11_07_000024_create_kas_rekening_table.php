<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_rekening', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_struktur')
                ->constrained('struktur_organisasi')
                ->restrictOnDelete();

            $table->enum('organisasi', ['IPNU', 'IPPNU', 'Bersama']);
            $table->string('nama_kas', 100);

            $table->enum('tipe', [
                'Tunai',
                'Bank',
                'E_Wallet'
            ]);

            $table->string('no_rekening', 50)->nullable();
            $table->string('atas_nama', 100)->nullable();

            $table->decimal('saldo_awal', 15, 2)->default(0);
            $table->decimal('saldo_sekarang', 15, 2)->default(0);

            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(
                ['id_struktur', 'organisasi', 'nama_kas'],
                'uq_kas_rekening'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_rekening');
    }
};

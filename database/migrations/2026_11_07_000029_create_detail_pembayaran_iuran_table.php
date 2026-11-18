<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pembayaran_iuran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pembayaran_iuran')
                ->constrained('pembayaran_iuran')
                ->cascadeOnDelete();

            $table->foreignId('id_tagihan_iuran')
                ->constrained('tagihan_iuran')
                ->restrictOnDelete();

            $table->decimal('nominal_dibayar', 15, 2);

            $table->timestamps();

            $table->unique(
                ['id_pembayaran_iuran', 'id_tagihan_iuran'],
                'uq_detail_pembayaran_tagihan'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pembayaran_iuran');
    }
};

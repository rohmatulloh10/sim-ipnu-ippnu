<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pihak_pendana', function (Blueprint $table) {
            $table->id();

            $table->enum('jenis_pihak', [
                'banom',
                'alumni',
                'lainnya'
            ]);

            $table->string('nama_pihak', 150);
            $table->string('kontak', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pihak_pendana');
    }
};

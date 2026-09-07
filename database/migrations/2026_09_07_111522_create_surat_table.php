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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->enum('kategori', ['ipnu', 'ippnu', 'masuk', 'bersama'])->default('bersama');
            $table->string('no_surat', 100);
            $table->string('asal_tujuan');
            $table->string('subjek');
            $table->date('tgl_surat');
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('surat');
    }
};

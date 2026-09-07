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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_kerja_id')->nullable()->constrained('program_kerja')->nullOnDelete();
            $table->enum('kategori_tipe', ['raker', 'incidental'])->default('raker');
            $table->string('nama_kegiatan');
            $table->string('lokasi')->nullable();
            $table->date('tgl_kegiatan')->nullable();
            $table->string('ketupel')->nullable();
            $table->string('bendahara')->nullable();
            $table->boolean('is_realized')->default(true);
            $table->text('catatan')->nullable();
            $table->string('dok_img')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};

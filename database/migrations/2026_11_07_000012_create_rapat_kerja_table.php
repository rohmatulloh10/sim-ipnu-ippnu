<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapat_kerja', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_masa_khidmat')
                ->constrained('masa_khidmat')
                ->restrictOnDelete();

            $table->enum('jenis_raker', ['Raker_1', 'Raker_2', 'Evaluasi']);
            $table->string('nama_raker', 150);
            $table->date('tgl_pelaksanaan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('file_notulen')->nullable();
            $table->text('keterangan')->nullable();

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapat_kerja');
    }
};

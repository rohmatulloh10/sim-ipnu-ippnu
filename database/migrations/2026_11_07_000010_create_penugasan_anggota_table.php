<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penugasan_anggota', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_anggota')
                ->constrained('anggota')
                ->restrictOnDelete();

            $table->foreignId('id_masa_khidmat')
                ->constrained('masa_khidmat')
                ->restrictOnDelete();

            $table->foreignId('id_departemen')
                ->nullable()
                ->constrained('departemen')
                ->nullOnDelete();

            $table->string('jabatan', 100)->nullable();
            $table->boolean('status_aktif')->default(true);

            $table->foreignId('created_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['id_anggota', 'id_masa_khidmat'],
                'uq_anggota_masa_khidmat'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penugasan_anggota');
    }
};

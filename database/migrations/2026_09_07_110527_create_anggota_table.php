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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nia', 100)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_telp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('departemen_id')->nullable()->constrained('departemen')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};

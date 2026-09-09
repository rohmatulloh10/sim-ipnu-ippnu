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
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa', 100);
            $table->boolean('is_active')->default(false); // Penanda desa yang sedang aktif
            $table->boolean('is_registered')->default(false); // Penanda desa yang sudah terdaftar di sistem
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('desa_id')->nullable()->after('id')->constrained('desa')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['desa_id']);
            $table->dropColumn('desa_id');
        });
        Schema::dropIfExists('desa');
    }
};

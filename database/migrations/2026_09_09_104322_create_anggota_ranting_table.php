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
        Schema::create('anggota_ranting', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nia', 100)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('jabatan', 100)->nullable(); // Contoh: Ketua, Sekretaris, Anggota
            $table->string('status_ktp', 50)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('pendidikan_terakhir', 50)->nullable();
            $table->string('media_sosial', 255)->nullable();
            $table->enum('jenjang_perkaderan', ['makesta', 'lakmud', 'lakpesma', 'lainnya'])->nullable();
            $table->text('riwayat_diklat')->nullable();
            $table->string('foto_anggota', 255)->nullable();
            $table->string('sertifikat_kader_img', 255)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::table('desa_masa_khidmat', function (Blueprint $table) {
            $table->foreignId('anggota_ranting_id')->nullable()->after('id')->constrained('anggota_ranting')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('desa_masa_khidmat', function (Blueprint $table) {
            $table->dropForeign(['anggota_ranting_id']);
            $table->dropColumn('anggota_ranting_id');
        });
        Schema::dropIfExists('anggota_ranting');
        Schema::dropIfExists('desa_masa_khidmat');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('id_struktur')
                ->nullable()
                ->constrained('struktur_organisasi')
                ->nullOnDelete();

            $table->string('modul', 50);

            $table->enum('aksi', [
                'CREATE',
                'UPDATE',
                'DELETE',
                'LOGIN'
            ]);

            $table->unsignedBigInteger('record_id')->nullable();

            $table->text('deskripsi')->nullable();
            $table->json('data_lama')->nullable();
            $table->json('data_baru')->nullable();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->index(['id_struktur', 'modul', 'created_at']);
            $table->index(['id_user', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};

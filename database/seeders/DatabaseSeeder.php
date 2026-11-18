<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Struktur Organisasi
        DB::table('struktur_organisasi')->insert([
            ['nama_unit' => 'PAC SUMOBITO', 'tingkat' => 'PAC'],
            ['nama_unit' => 'Ranting Badas', 'tingkat' => 'Ranting'],
            ['nama_unit' => 'Ranting Brudu', 'tingkat' => 'Ranting'],
            ['nama_unit' => 'Pengurus Komisariat', 'tingkat' => 'Pengurus Komisariat'],
        ]);

        // 2. Masa Khidmat
        DB::table('masa_khidmat')->insert([
            ['id_struktur' => 1, 'nama_periode' => '2023-2026', 'tahun_mulai' => 2023, 'tahun_selesai' => 2026, 'is_active' => true],
            ['id_struktur' => 2, 'nama_periode' => '2023-2026', 'tahun_mulai' => 2023, 'tahun_selesai' => 2026, 'is_active' => true],
            ['id_struktur' => 3, 'nama_periode' => '2023-2026', 'tahun_mulai' => 2023, 'tahun_selesai' => 2026, 'is_active' => true],
            ['id_struktur' => 4, 'nama_periode' => '2023-2026', 'tahun_mulai' => 2023, 'tahun_selesai' => 2026, 'is_active' => true],
        ]);

        // 3. Master Departemen
        DB::table('departemen')->insert([
            ['nama_departemen' => 'Departemen Keanggotaan', 'deskripsi' => 'Departemen yang bertanggung jawab dalam pengelolaan data anggota dan keanggotaan organisasi.'],
            ['nama_departemen' => 'Departemen Pendidikan dan Pelatihan', 'deskripsi' => 'Departemen yang bertanggung jawab dalam penyelenggaraan pendidikan dan pelatihan bagi anggota organisasi.'],
            ['nama_departemen' => 'Departemen Kaderisasi', 'deskripsi' => 'Departemen yang bertanggung jawab dalam proses kaderisasi anggota organisasi.'],
            ['nama_departemen' => 'Departemen Humas dan Komunikasi', 'deskripsi' => 'Departemen yang bertanggung jawab dalam mengelola hubungan dengan pihak eksternal dan komunikasi internal organisasi.'],
            ['nama_departemen' => 'Departemen Keuangan', 'deskripsi' => 'Departemen yang bertanggung jawab dalam pengelolaan keuangan organisasi.'],
            ['nama_departemen' => 'Departemen Kesejahteraan Anggota', 'deskripsi' => 'Departemen yang bertanggung jawab dalam mengelola program kesejahteraan bagi anggota organisasi.'],
            ['nama_departemen' => 'Departemen Pengembangan Organisasi', 'deskripsi' => 'Departemen yang bertanggung jawab dalam pengembangan dan perbaikan struktur serta sistem organisasi.'],
        ]);

        // 4. Jalankan Seeder 6 Role & 28 Menu Permission
        $this->call(MenuPermissionSeeder::class);
        $this->call(UserStrukturRoleSeeder::class);

        // 5. Akun User Awal
        $adminUserId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

// 6. Penugasan Role ke User Admin (Super Admin di PAC SUMOBITO & Admin di Ranting Badas)
        $superAdminRoleId = DB::table('roles')->where('nama_role', 'Super Admin')->value('id');
        $adminRoleId      = DB::table('roles')->where('nama_role', 'Admin')->value('id');

        DB::table('user_struktur_roles')->insert([
            [
                'user_id' => $adminUserId,
                'role_id' => $superAdminRoleId,
                'id_struktur' => 1, // PAC SUMOBITO
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $adminUserId,
                'role_id' => $adminRoleId,
                'id_struktur' => 2, // Ranting Badas
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 7. Data Anggota
        DB::table('anggota')->insert([
            ['nia' => 'PAC001', 'nik' => '12345678901234', 'nama_lengkap' => 'Rohmatulloh', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Jombang', 'tanggal_lahir' => '2000-01-01', 'pendidikan_terakhir' => 'S1', 'media_sosial' => 'matthzz', 'jenjang_perkaderan' => 'makesta', 'riwayat_diklat' => 'Diklat Dasar', 'no_hp' => '081234567890', 'alamat' => 'Jl. Raya No. 1, Jombang', 'foto' => null, 'sertifikat_kader' => null, 'created_by' => $adminUserId, 'updated_by' => $adminUserId],
            ['nia' => 'PAC002', 'nik' => '12345678901235', 'nama_lengkap' => 'Ahmad Fauzi', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Jombang', 'tanggal_lahir' => '2000-02-02', 'pendidikan_terakhir' => 'S1', 'media_sosial' => '@ahmadfauzi', 'jenjang_perkaderan' => 'lakmud', 'riwayat_diklat' => 'Diklat Lanjutan', 'no_hp' => '081234567891', 'alamat' => 'Jl. Raya No. 2, Jombang', 'foto' => null, 'sertifikat_kader' => null, 'created_by' => $adminUserId, 'updated_by' => $adminUserId],
            ['nia' => 'PAC003', 'nik' => '12345678901236', 'nama_lengkap' => 'Siti Aisyah', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Jombang', 'tanggal_lahir' => '2000-03-03', 'pendidikan_terakhir' => 'S1', 'media_sosial' => '@sitiaisyah', 'jenjang_perkaderan' => null, 'riwayat_diklat' => null, 'no_hp' => null, 'alamat' => null, 'foto' => null, 'sertifikat_kader' => null, 'created_by' => $adminUserId, 'updated_by' => $adminUserId],
            ['nia' => 'PAC004', 'nik' => '12345678901237', 'nama_lengkap' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Jombang', 'tanggal_lahir' => '2000-04-04', 'pendidikan_terakhir' => null, 'media_sosial' => null, 'jenjang_perkaderan' => null, 'riwayat_diklat' => null, 'no_hp' => null, 'alamat' => null, 'foto' => null, 'sertifikat_kader' => null, 'created_by' => $adminUserId, 'updated_by' => $adminUserId],
        ]);

        // 8. Penugasan Anggota
        DB::table('penugasan_anggota')->insert([
            ['id_anggota' => 1, 'id_departemen' => 1, 'id_masa_khidmat' => 1, 'jabatan' => 'Ketua'],
            ['id_anggota' => 2, 'id_departemen' => 2, 'id_masa_khidmat' => 2, 'jabatan' => 'Sekretaris'],
            ['id_anggota' => 3, 'id_departemen' => 3, 'id_masa_khidmat' => 3, 'jabatan' => 'Bendahara'],
            ['id_anggota' => 4, 'id_departemen' => 4, 'id_masa_khidmat' => 4, 'jabatan' => 'Anggota'],
        ]);
    }
}
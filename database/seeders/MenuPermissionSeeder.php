<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Master 28 Menu Permission
        $permissions = [
            // Utama
            ['nama_permission' => 'menu.dashboard', 'label_menu' => 'Dashboard', 'kategori' => 'Utama'],

            // Organisasi
            ['nama_permission' => 'organisasi.struktur.view', 'label_menu' => 'Kelola Struktur Organisasi', 'kategori' => 'Organisasi'],
            ['nama_permission' => 'organisasi.periode.view', 'label_menu' => 'Kelola Masa Khidmat', 'kategori' => 'Organisasi'],
            ['nama_permission' => 'organisasi.departemen.view', 'label_menu' => 'Kelola Master Departemen', 'kategori' => 'Organisasi'],

            // Anggota
            ['nama_permission' => 'anggota.biodata.view', 'label_menu' => 'Kelola Biodata Anggota', 'kategori' => 'Anggota'],
            ['nama_permission' => 'anggota.penugasan.view', 'label_menu' => 'Kelola Penugasan & Jabatan', 'kategori' => 'Anggota'],

            // Program Kerja
            ['nama_permission' => 'proker.kategori.view', 'label_menu' => 'Kelola Kategori Proker', 'kategori' => 'Program Kerja'],
            ['nama_permission' => 'proker.raker.view', 'label_menu' => 'Kelola Rapat Kerja & Notulen', 'kategori' => 'Program Kerja'],
            ['nama_permission' => 'proker.daftar.view', 'label_menu' => 'Kelola Program Kerja & Panitia', 'kategori' => 'Program Kerja'],
            ['nama_permission' => 'proker.realisasi.view', 'label_menu' => 'Kelola Realisasi & LPJ Proker', 'kategori' => 'Program Kerja'],

            // Kesekretariatan
            ['nama_permission' => 'surat.kategori.view', 'label_menu' => 'Kelola Kategori Surat', 'kategori' => 'Kesekretariatan'],
            ['nama_permission' => 'surat.masuk.view', 'label_menu' => 'Kelola Surat Masuk & Disposisi', 'kategori' => 'Kesekretariatan'],
            ['nama_permission' => 'surat.keluar.view', 'label_menu' => 'Kelola Surat Keluar', 'kategori' => 'Kesekretariatan'],
            ['nama_permission' => 'surat.arsip.view', 'label_menu' => 'Kelola Arsip Dokumen', 'kategori' => 'Kesekretariatan'],

            // Inventaris
            ['nama_permission' => 'inventaris.kategori.view', 'label_menu' => 'Kelola Kategori Inventaris', 'kategori' => 'Inventaris'],
            ['nama_permission' => 'inventaris.barang.view', 'label_menu' => 'Kelola Data Inventaris', 'kategori' => 'Inventaris'],
            ['nama_permission' => 'inventaris.peminjaman.view', 'label_menu' => 'Kelola Peminjaman Inventaris', 'kategori' => 'Inventaris'],

            // Keuangan
            ['nama_permission' => 'keuangan.kas.view', 'label_menu' => 'Kelola Kas & Rekening', 'kategori' => 'Keuangan'],
            ['nama_permission' => 'keuangan.kategori.view', 'label_menu' => 'Kelola Kategori Keuangan', 'kategori' => 'Keuangan'],
            ['nama_permission' => 'keuangan.transaksi.view', 'label_menu' => 'Kelola Transaksi Kas', 'kategori' => 'Keuangan'],

            // Iuran
            ['nama_permission' => 'iuran.tagihan.view', 'label_menu' => 'Kelola Tagihan Iuran', 'kategori' => 'Iuran'],
            ['nama_permission' => 'iuran.pembayaran.view', 'label_menu' => 'Kelola Pembayaran Iuran', 'kategori' => 'Iuran'],

            // Pendanaan
            ['nama_permission' => 'pendanaan.pihak.view', 'label_menu' => 'Kelola Master Pihak Pendana', 'kategori' => 'Pendanaan'],
            ['nama_permission' => 'pendanaan.proposal.view', 'label_menu' => 'Kelola Proposal Pendanaan', 'kategori' => 'Pendanaan'],
            ['nama_permission' => 'pendanaan.penerimaan.view', 'label_menu' => 'Kelola Penerimaan Dana Proker', 'kategori' => 'Pendanaan'],

            // Pengguna & Audit
            ['nama_permission' => 'akses.users.view', 'label_menu' => 'Kelola Akun Pengguna', 'kategori' => 'Pengguna'],
            ['nama_permission' => 'akses.assignment.view', 'label_menu' => 'Kelola Penugasan Role User', 'kategori' => 'Pengguna'],
            ['nama_permission' => 'akses.roles.view', 'label_menu' => 'Kelola Role & Permission', 'kategori' => 'Pengguna'],
            ['nama_permission' => 'audit.logs.view', 'label_menu' => 'Lihat Audit Logs Sistem', 'kategori' => 'Audit'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['nama_permission' => $permission['nama_permission']],
                [
                    'label_menu' => $permission['label_menu'],
                    'kategori' => $permission['kategori'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 2. Definisi 5 Role Generik (Berlaku untuk PAC, Ranting, maupun Komisariat)
        $allPermissions = array_column($permissions, 'nama_permission');

        $rolesConfig = [
            'Super Admin' => [
                'deskripsi' => 'Akses penuh ke seluruh struktur organisasi, master global, dan pengaturan role.',
                'permissions' => $allPermissions,
            ],
            'Admin' => [
                'deskripsi' => 'Administrator unit organisasi (PAC / Ranting / Komisariat) sesuai struktur penugasannya.',
                'permissions' => array_diff($allPermissions, [
                    'organisasi.struktur.view',
                    'organisasi.departemen.view',
                    'surat.kategori.view',
                    'inventaris.kategori.view',
                    'keuangan.kategori.view',
                    'akses.roles.view',
                ]),
            ],
            'Sekretaris' => [
                'deskripsi' => 'Pengelola administrasi kesekretariatan, anggota, arsip, dan proker pada strukturnya.',
                'permissions' => [
                    'menu.dashboard',
                    'organisasi.periode.view',
                    'anggota.biodata.view',
                    'anggota.penugasan.view',
                    'proker.kategori.view',
                    'proker.raker.view',
                    'proker.daftar.view',
                    'proker.realisasi.view',
                    'surat.masuk.view',
                    'surat.keluar.view',
                    'surat.arsip.view',
                    'inventaris.barang.view',
                    'inventaris.peminjaman.view',
                    'pendanaan.pihak.view',
                    'pendanaan.proposal.view',
                    'akses.users.view',
                    'akses.assignment.view',
                ],
            ],
            'Bendahara' => [
                'deskripsi' => 'Pengelola keuangan, kas rekening, iuran anggota, dan dana proker pada strukturnya.',
                'permissions' => [
                    'menu.dashboard',
                    'proker.daftar.view',
                    'proker.realisasi.view',
                    'keuangan.kas.view',
                    'keuangan.transaksi.view',
                    'iuran.tagihan.view',
                    'iuran.pembayaran.view',
                    'pendanaan.pihak.view',
                    'pendanaan.proposal.view',
                    'pendanaan.penerimaan.view',
                ],
            ],
            'Admin Departemen' => [
                'deskripsi' => 'Koordinator / Admin departemen untuk pengelolaan program kerja dan disposisi surat.',
                'permissions' => [
                    'menu.dashboard',
                    'anggota.biodata.view',
                    'proker.raker.view',
                    'proker.daftar.view',
                    'proker.realisasi.view',
                    'surat.masuk.view',
                    'inventaris.barang.view',
                    'inventaris.peminjaman.view',
                    'pendanaan.proposal.view',
                ],
            ],
        ];

        $permissionMap = DB::table('permissions')->pluck('id', 'nama_permission');

        foreach ($rolesConfig as $namaRole => $config) {
            DB::table('roles')->updateOrInsert(
                ['nama_role' => $namaRole],
                [
                    'deskripsi' => $config['deskripsi'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $roleId = DB::table('roles')->where('nama_role', $namaRole)->value('id');

            // Sinkronkan ulang izin agar bersih jika seeder dijalankan ulang
            DB::table('role_has_permissions')->where('role_id', $roleId)->delete();

            foreach ($config['permissions'] as $permName) {
                $permId = $permissionMap[$permName] ?? null;
                if ($roleId && $permId) {
                    DB::table('role_has_permissions')->insert([
                        'role_id' => $roleId,
                        'permission_id' => $permId,
                    ]);
                }
            }
        }
    }
}
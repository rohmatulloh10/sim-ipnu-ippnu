<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserStrukturRoleSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        // Ambil mapping ID Role dan ID Struktur berdasarkan nama agar tidak salah ID
        $roles = DB::table('roles')->pluck('id', 'nama_role');
        $strukturs = DB::table('struktur_organisasi')->pluck('id', 'nama_unit');

        $usersData = [
            [
                'name' => 'Muhammad Rizky Pratama',
                'username' => 'rizky.pratama',
                'email' => 'rizky.pratama@example.com',
                'assignments' => [
                    // Punya 2 Role di 2 Struktur berbeda:
                    ['role' => 'Sekretaris', 'struktur' => 'PAC SUMOBITO'],
                    ['role' => 'Admin', 'struktur' => 'Ranting Badas'],
                ],
            ],
            [
                'name' => 'Siti Nurhaliza Putri',
                'username' => 'siti.nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'assignments' => [
                    // Punya 2 Role di struktur yang sama (PAC SUMOBITO):
                    ['role' => 'Bendahara', 'struktur' => 'PAC SUMOBITO'],
                    ['role' => 'Admin Departemen', 'struktur' => 'PAC SUMOBITO'],
                ],
            ],
            [
                'name' => 'Ahmad Zulkarnain',
                'username' => 'ahmad.zulkarnain',
                'email' => 'ahmad.zulkarnain@example.com',
                'assignments' => [
                    // Punya 2 Role lintas tingkat (PAC & Komisariat):
                    ['role' => 'Admin Departemen', 'struktur' => 'PAC SUMOBITO'],
                    ['role' => 'Sekretaris', 'struktur' => 'Pengurus Komisariat'],
                ],
            ],
            [
                'name' => 'Dewi Lestari Anggraini',
                'username' => 'dewi.lestari',
                'email' => 'dewi.lestari@example.com',
                'assignments' => [
                    // Punya 1 Role saja (langsung masuk ke dashboard tanpa halaman pilih struktur):
                    ['role' => 'Admin', 'struktur' => 'Ranting Brudu'],
                ],
            ],
            [
                'name' => 'Fajar Maulana Hakim',
                'username' => 'fajar.maulana',
                'email' => 'fajar.maulana@example.com',
                'assignments' => [
                    // Punya 1 Role saja:
                    ['role' => 'Bendahara', 'struktur' => 'Ranting Badas'],
                ],
            ],
        ];

        foreach ($usersData as $item) {
            DB::table('users')->updateOrInsert(
                ['username' => $item['username']],
                [
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'password' => $password,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $userId = DB::table('users')->where('username', $item['username'])->value('id');

            foreach ($item['assignments'] as $assign) {
                $roleId = $roles[$assign['role']] ?? null;
                $strukturId = $strukturs[$assign['struktur']] ?? null;

                if ($userId && $roleId && $strukturId) {
                    DB::table('user_struktur_roles')->updateOrInsert(
                        [
                            'user_id' => $userId,
                            'role_id' => $roleId,
                            'id_struktur' => $strukturId,
                        ],
                        [
                            'is_active' => true,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */



    public function run(): void
    {
        // User::factory(10)->create();
        // $this->call([
        //     RoleSeeder::class,
        //     UserSeeder::class,
        // ]);
        DB::table('role')->insert([
            ['name' => 'superadmin'],
            ['name' => 'bph'],
            ['name' => 'sekretaris'],
            ['name' => 'bendahara'],
            ['name' => 'dept_head'],
            ['name' => 'admin_desa'],
        ]);
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'anggota_id' => null,
            'desa_id' => null,
        ]);
    }
}

<?php

namespace App\Models\Pengguna\Models;

use App\Models\Pengguna\Models\Permissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Pengguna\Models\User_StrukturRoles;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nama_role',
        'deskripsi',
    ];

    /**
     * Satu role dapat diberikan kepada banyak user
     * melalui tabel user_struktur_roles.
     */
    public function userStrukturRoles(): HasMany
    {
        return $this->hasMany(User_StrukturRoles::class, 'role_id');
    }

    /**
     * Satu role dapat memiliki banyak permission.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permissions::class,
            'role_has_permissions',
            'role_id',
            'permission_id'
        );
    }
//Saat ini di Role.php baru ada relasi ke pivot userStrukturRoles(). Jika nanti Anda ingin menampilkan daftar user yang punya role tertentu secara langsung ($role->users), Anda bisa menambahkan relasi many-to-many ini di
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'user_struktur_roles',
            'role_id',
            'user_id'
        )->withPivot(['id', 'id_struktur', 'is_active'])
        ->withTimestamps();
    }
    // Berguna jika sewaktu-waktu Anda mengecek izin langsung dari objek $role (misalnya saat melakukan seeder atau validasi di halaman edit role):
    public function hasPermission(string $namaPermission): bool
    {
        return $this->permissions()
            ->where('nama_permission', $namaPermission)
            ->exists();
    }
}

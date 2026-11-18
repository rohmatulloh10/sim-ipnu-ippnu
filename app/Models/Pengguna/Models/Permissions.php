<?php

namespace App\Models\Pengguna\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Pengguna\Models\Role;

class Permissions extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'nama_permission',
        'label_menu',
        'kategori',
    ];

    /**
     * Satu permission dapat dimiliki banyak role.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'role_has_permissions',
            'permission_id',
            'role_id'
        );
    }
}

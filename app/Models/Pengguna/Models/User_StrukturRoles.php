<?php

namespace App\Models\Pengguna\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pengguna\Models\Role;
use App\Models\Organisasi\Models\StrukturOrganisasi;
use App\Models\User;

class User_StrukturRoles extends Model
{
    protected $table = 'user_struktur_roles';

    protected $fillable = [
        'user_id',
        'role_id',
        'id_struktur',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Setiap data penugasan role dimiliki satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Setiap data penugasan role memiliki satu role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Setiap data penugasan role berada pada satu struktur.
     */
    public function strukturOrganisasi(): BelongsTo
    {
        return $this->belongsTo(StrukturOrganisasi::class, 'id_struktur');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Pengguna\Models\User_StrukturRoles;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;



/**
 * @property int $id
 * @property string $username
 * @property bool $is_active
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['name', 'username', 'email', 'password', 'is_active'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function strukturRoles(): HasMany
    {
        return $this->hasMany(User_StrukturRoles::class, 'user_id');
    }

    /**
     * Ambil record penugasan aktif (User_StrukturRoles) saat ini
     */
    public function activeAssignment(?int $assignmentId = null)
    {
        $assignmentId = $assignmentId ?? session('active_assignment_id');

        if (! $assignmentId) {
            return null;
        }

        return $this->strukturRoles()
            ->with(['role.permissions', 'strukturOrganisasi'])
            ->where('is_active', true)
            ->find($assignmentId);
    }

    /**
     * Cek apakah penugasan aktif saat ini memiliki permission tertentu
     */
    public function hasActivePermission(string $namaPermission, ?int $assignmentId = null): bool
    {
        $assignment = $this->activeAssignment($assignmentId);

        if (! $assignment || ! $assignment->role) {
            return false;
        }

        return $assignment->role->permissions
            ->contains('nama_permission', $namaPermission);
    }

    /**
     * Ambil daftar nama_permission milik penugasan aktif (untuk React/Inertia)
     */
    public function getActivePermissions(?int $assignmentId = null): array
    {
        $assignment = $this->activeAssignment($assignmentId);

        if (! $assignment || ! $assignment->role) {
            return [];
        }

        return $assignment->role->permissions
            ->pluck('nama_permission')
            ->toArray();
    }


}

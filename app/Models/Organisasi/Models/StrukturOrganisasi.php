<?php

namespace App\Models\Organisasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Pengguna\Models\User_StrukturRoles;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasi';

    protected $fillable = [
        'nama_unit',
        'tingkat',
    ];

    public function userStrukturRoles(): HasMany
    {
        return $this->hasMany(User_StrukturRoles::class, 'id_struktur');
    }
}

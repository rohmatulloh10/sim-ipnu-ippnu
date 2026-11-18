<?php

namespace App\Models\Organisasi\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departemen';

    protected $fillable = [
        'nama_departemen',
        'deskripsi',
    ];

    // public function penugasanAnggota()
    // {
    //     return $this->hasMany(PenugasanAnggota::class, 'id_departemen');
    // }
}

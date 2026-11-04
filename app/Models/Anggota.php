<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id';
    protected $fillable = [
        'departemen_id',
        'nama',
        'nia',
        'jenis_kelamin',
        'jabatan_pac',
        'status_ktp',
        'pekerjaan',
        'pendidikan_terakhir',
        'media_sosial',
        'jenjang_perkaderan',
        'riwayat_diklat',
        'foto_anggota',
        'sertifikat_kader_img',
        'no_telp',
        'alamat',
        'status',
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function masaKhidmat()
    {
        return $this->hasMany(MasaKhidmat::class, 'anggota_id');
    }
}

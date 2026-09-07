<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasaKhidmat extends Model
{
    use HasFactory;
    protected $table = 'masa_khidmat';
    protected $guarded = ['id'];
    protected $fillable = ['nama_periode', 'tgl_mulai', 'tgl_selesai', 'is_active'];

    public function departemen()
    {
        return $this->hasMany(Departemen::class, 'masa_khidmat_id');
    }
}

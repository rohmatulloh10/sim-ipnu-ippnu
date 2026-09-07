<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departemen extends Model
{
    use HasFactory;
    protected $table = 'departemen';
    protected $guarded = ['id'];
    protected $fillable = ['masa_khidmat_id', 'nama', 'deskripsi'];

    public function masaKhidmat()
    {
        return $this->belongsTo(MasaKhidmat::class, 'masa_khidmat_id');
    }
}

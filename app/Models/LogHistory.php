<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'log_history';

    // Membuka akses mass-assignment kecuali untuk kolom id
    protected $guarded = ['id'];

    /**
     * Relasi ke tabel users
     * Setiap log history dimiliki oleh satu user (akun pengurus)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

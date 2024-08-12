<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TL_PL_Panmud_Hukum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_laporan',
        'jenis',
        'bulan',
        'minggu',
        'file_path',
        'user_id',
        'nama',   // Tambahkan kolom 'nama'
        'nip',    // Tambahkan kolom 'nip'
        'bidang', // Tambahkan kolom 'bidang'
        'role'    // Tambahkan kolom 'role'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

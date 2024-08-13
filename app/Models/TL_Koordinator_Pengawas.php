<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TL_Koordinator_Pengawas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_laporan',
        'bulan',
        'file_path',
        'user_id',
        'nama',   // Tambahkan kolom 'nama'
        'nip',    // Tambahkan kolom 'nip'
        'role'    // Tambahkan kolom 'role'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk mendapatkan nama laporan beserta format file-nya
    public function getNamaLaporanWithFormatAttribute()
    {
        $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
        return "{$this->nama_laporan}.{$extension}";
    }
}

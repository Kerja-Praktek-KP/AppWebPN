<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TL_PL_Panmud_Hukum extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'nama_laporan',
        'jenis',
        'bulan',
        'minggu',
        'file_path',
        'user_id',
        'nama',
        'nip',
        'bidang',
        'role'
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

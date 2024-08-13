<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temuan_PW_Sub_Bag_Umum_dan_Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_temuan',
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

    public function getNamaLaporanWithFormatAttribute()
    {
        $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
        return "{$this->nama_temuan}.{$extension}";
    }
}

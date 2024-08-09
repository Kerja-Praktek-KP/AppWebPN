<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TL_Koordinator_Pengawas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_laporan',
        'tanggal_laporan',
        'file_path',
        'user_id'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

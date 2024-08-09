<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TL_PL_Sub_Bag_Umum_dan_Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_laporan',
        'jenis',
        'file_path',
        'user_id'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temuan_PW_Panmud_Hukum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_temuan',
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

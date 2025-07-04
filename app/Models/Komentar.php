<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $fillable = ['cafe_id', 'nama', 'isi_komentar', 'disetujui'];
    

    public function cafe()
    {
        return $this->belongsTo(\App\Models\Cafe::class, 'cafe_id');
    }
}

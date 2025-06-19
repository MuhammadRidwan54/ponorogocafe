<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasRuang extends Model
{
    use HasFactory;

    protected $table = 'kapasitasruang';

    protected $fillable = [
        'kapasitas_ruang',
    ];
}

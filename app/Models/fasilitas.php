<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';

    protected $fillable = [
        'nama_fasilitas',
        'icon_svg',
      
    ];

    // Relasi jika satu fasilitas bisa digunakan oleh banyak cafe
  public function cafe()
{
    return $this->belongsToMany(Cafe::class, 'cafe_fasilitas');
}

}

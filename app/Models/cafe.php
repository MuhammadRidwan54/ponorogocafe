<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;

    protected $table = 'cafe';

    protected $fillable = [
        'nama_cafe',
        'alamat',
        'alamat_url',
        'thumbnail', // Disimpan sebagai string (path ke gambar)
        'gambar', // Disimpan dalam bentuk JSON (array)
        'hargamenu_id',
        'kapasitasruang_id',
        'tempatparkir_id',
        'jambuka_id',
    ];

    // Ubah string ke array jika kamu ingin simpan multiple gambar
    protected $casts = [
        'gambar' => 'array',
    ];

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'cafe_fasilitas');
    }

    public function hargamenu()
    {
        return $this->belongsTo(HargaMenu::class);
    }


    public function kapasitasruang()
    {
        return $this->belongsTo(KapasitasRuang::class);
    }

    public function tempatparkir()
    {
        return $this->belongsTo(TempatParkir::class);
    }

    public function jambuka()
    {
        return $this->belongsTo(Jambuka::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function komentar()
    {
        return $this->hasMany(\App\Models\Komentar::class, 'cafe_id');
    }
    public function labels()
    {
        return $this->belongsToMany(Label::class, 'cafe_label');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaMenu extends Model
{
    use HasFactory;

    protected $table = 'hargamenu';

    protected $fillable = [
        'harga_menu',
    ];
}

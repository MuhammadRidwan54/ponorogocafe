<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JamBuka extends Model
{
    use HasFactory;

    protected $table = 'jambuka';

    protected $fillable = [
        'jam_buka',
        'waktu_buka',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Label extends Model
{
    use HasFactory;

    protected $table = 'label';

    protected $fillable = [
        'nama_label',
    ];
    public function cafes()
{
    return $this->belongsToMany(Cafe::class, 'cafe_label');
}


}

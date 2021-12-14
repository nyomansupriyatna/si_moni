<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingRegu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_regu',
        'nama_teknisi1',
        'nama_teknisi2',
    ];
}

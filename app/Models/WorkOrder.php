<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_psb',
        'nama_pelanggan',
        'alamat',
        'pic',
        'datek',
        'keterangan',
        'mapping_regu_id',
        'user_id',
    ];

    public function mapping_regus()
    {
        return $this->belongsTo(MappingRegu::class, 'mapping_regu_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

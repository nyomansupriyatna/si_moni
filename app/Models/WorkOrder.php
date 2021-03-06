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
        'nama_layanan',
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

    //user yang input WO, bukan mapping regu /teknisi
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function progres_work_order()
    {
        return $this->hasOne(ProgresWorkOrder::class, 'wo_id');
    }
}

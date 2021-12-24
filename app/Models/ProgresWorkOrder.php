<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresWorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'wo_id',
        'user_id',
        'tanggal',
        'zn_modem',
        'jumlah_ap',
        'panjang_dc',
        'material_lain',
        'keterangan_tambahan',
        'foto_odp',
        'foto_rumah_pelanggan',
        'foto_modem',
        'foto_ap',
        'status',
        'foto_kendala',
    ];

    public function work_orders()
    {
        return $this->belongsTo(WorkOrder::class, 'wo_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

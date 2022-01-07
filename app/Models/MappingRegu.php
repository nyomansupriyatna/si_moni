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
    ];

    //relation ke teknisi (mapping regu)
    public function user()
    {
        return $this->belongsToMany(User::class, 'regu_users');
    }

    public function regu_user()
    {
        return $this->hasMany(ReguUser::class);
    }

}

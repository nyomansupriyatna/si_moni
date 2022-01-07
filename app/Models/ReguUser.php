<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReguUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mapping_regu_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function mapping_regu()
    {
        return $this->belongsTo(MappingRegu::class, 'mapping_regu_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inspeccion()
    {
        return $this->hasOne(Inspeccion::class);
    }

    public function tomador()
    {
        return $this->belongsTo(Tomador::class);
    }
}

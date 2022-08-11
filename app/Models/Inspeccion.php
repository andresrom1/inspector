<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
    use HasFactory;

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class);
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}

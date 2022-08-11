<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tomador extends Model
{
    use HasFactory;

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class);
    }
}

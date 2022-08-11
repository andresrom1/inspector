<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $guarded =[];

   public function inspeccion()
   {
        return $this->belongsTo(Inspeccion::class);
   }
}

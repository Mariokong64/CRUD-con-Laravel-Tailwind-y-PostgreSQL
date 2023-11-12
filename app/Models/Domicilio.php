<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    public $timestamps = false;
    use HasFactory;

    // Relación con Ciudadano
    public function ciudadano()
    {
        return $this->hasOne(Ciudadano::class, 'id_domicilio');
    }

    // Relación con Estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    // Relación con Domicilio
    public function domicilio()
    {
        return $this->hasOne(Domicilio::class, 'id_estado');
    }
}

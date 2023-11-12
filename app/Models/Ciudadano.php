<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudadano extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'id_domicilio');
    }
}

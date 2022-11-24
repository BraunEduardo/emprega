<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function vagas()
    {
        return $this->hasMany(Vaga::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}

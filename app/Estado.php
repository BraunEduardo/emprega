<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public $timestamps = false;

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'estado_id');
    }
}

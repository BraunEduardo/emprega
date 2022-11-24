<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $fillable = ['pessoa_id', 'vaga_id'];
    protected $table = 'inscricoes';

    public function vaga()
    {
        return $this->belongsTo(Vaga::class);
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}

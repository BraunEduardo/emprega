<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formacao extends Model
{
    public const SITUACOES = [
        'Incompleto',
        'Completo',
    ];

    protected $table = 'formacoes';
    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}

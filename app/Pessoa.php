<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    public const ESTADOS_CIVIS = [
        'Solteiro',
        'Casado',
        'Separado',
        'Divorciado',
        'Viúvo',
    ];

    public const GRAUS_ENSINO = [
        'Analfabeto',
        'Ensino fundamental incompleto',
        'Ensino fundamental completo',
        'Ensino médio incompleto',
        'Ensino médio completo',
        'Superior incompleto',
        'Superior completo',
    ];

    public $casts = [
        'nascimento' => 'date',
    ];

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class);
    }

    public function formacoes()
    {
        return $this->hasMany(Formacao::class);
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}

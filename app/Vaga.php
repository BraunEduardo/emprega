<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $table = 'vagas';
    public $timestamps = false;

    public function delete()
    {
        $this->inscricoes()->delete();
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class);
    }

    public function getRemuneracaoAttribute($remuneracao)
    {
        return number_format($remuneracao, 2, ',', '.');
    }

    public function setRemuneracaoAttribute($remuneracao)
    {
        $this->attributes['remuneracao'] = str_replace(['.', ','], ['', '.'], $remuneracao);
    }
}

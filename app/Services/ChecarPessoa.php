<?php

namespace App\Services;

use App\Pessoa;

class ChecarPessoa
{
    public function executar(array $dados)
    {
        $pessoa = Pessoa::where('cpf', $dados['cpf'])
            ->where('nome', $dados['nome'])
            ->where('nascimento', $dados['nascimento']);

        if ($pessoa->exists()) {
            return $pessoa->first();
        } else {
            return null;
        }
    }
}

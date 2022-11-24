<?php

namespace App\Services;

use App\Empresa;

class ChecarEmpresa
{
    public function executar(array $dados)
    {
        $empresa = Empresa::where('cnpj', $dados['cnpj'])
            ->where('razao_social', $dados['razao_social']);

        if ($empresa->exists()) {
            return $empresa->first();
        } else {
            return null;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SystemController extends Controller
{
    public function index(Request $request)
    {
        $cookie_pessoa = $request->cookie('pessoa');

        if (null === $cookie_pessoa) {
            return view('inicio');
        } else {
            $cookie_pagina = $request->cookie('pagina');

            if (null === $cookie_pagina) {
                return redirect()->route('formulario.edit', ['id' => $cookie_pessoa]);
            } else {
                switch ($cookie_pagina) {
                    case 'busca':
                        $cookie_termo = $request->cookie('termo');

                        return redirect()->route($cookie_pagina, ['busca' => $cookie_termo]);
                        break;
                    case 'formulario.edit':
                    case 'formEmpresa.edit':
                        Session::forget('_old');

                        return redirect()->route($cookie_pagina, ['id' => $cookie_pessoa]);
                        break;

                    default:
                        return redirect()->route($cookie_pagina);
                        break;
                }
            }
        }
    }

    public function minhaPagina(Request $request)
    {
        $cookie_pessoa = $request->cookie('pessoa');

        if (null === $cookie_pessoa) {
            return view('inicio');
        } else {
            $cookie_tpessoa = $request->cookie('tpessoa');

            if ('empregado' === $cookie_tpessoa) {
                $pessoa = Pessoa::with(['inscricoes', 'inscricoes.vaga', 'inscricoes.vaga.empresa', 'inscricoes.vaga.empresa.municipio', 'inscricoes.vaga.empresa.municipio.estado'])
                    ->find($cookie_pessoa);

                return view('pagina_pessoa', compact('pessoa'));
            } else {
                $empresa = Empresa::with(['vagas', 'municipio', 'municipio.estado'])
                    ->find($cookie_pessoa);

                return view('pagina_empresa', compact('empresa'));
            }
        }
    }

    public function buscar(Request $request)
    {
        $cookie_pessoa = $request->cookie('pessoa');

        if (null === $cookie_pessoa) {
            return view('inicio');
        } else {
            $cookie_tpessoa = $request->cookie('tpessoa');

            if ('empregado' === $cookie_tpessoa) {
                return PessoaController::buscar($request);
            } else {
                return EmpresaController::buscar($request);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Experiencia;
use App\Formacao;
use App\Http\Requests\PessoaRequest;
use App\Inscricao;
use App\Pessoa;
use App\Services\ChecarPessoa;
use App\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checar(Request $request, ChecarPessoa $checarPessoa)
    {
        $dados = $request->only(['cpf', 'nome', 'nascimento']);
        $pessoa = $checarPessoa->executar($dados);

        if (null === $pessoa) {
            foreach ($dados as $chave => $valor) {
                session(['_old_input.'.$chave => $valor]);
            }

            return redirect(route('formulario'));
        } else {
            Cookie::queue('pessoa', $pessoa->id, 864000);
            Cookie::queue('tpessoa', 'empregado', 864000);

            return $this->show($pessoa->id);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastro()
    {
        session()->forget('_old_input');
        Cookie::queue('pagina', 'cadastro');

        return view('cadastro');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario()
    {
        return view('formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function salvar(PessoaRequest $request, ChecarPessoa $checarPessoa)
    {
        DB::beginTransaction();
        $pessoa = $checarPessoa->executar($request->only(['cpf', 'nome', 'nascimento']));

        if (null === $pessoa) {
            $pessoa = new Pessoa();
            $pessoa->nome = $request->input('nome');
            $pessoa->nascimento = $request->input('nascimento');
            $pessoa->cpf = $request->input('cpf');
            $pessoa->telefone = $request->input('telefone');
            $pessoa->email = $request->input('email');
            $pessoa->grau_ensino = $request->input('grau_ensino');
            $pessoa->municipio_id = $request->input('municipio_id');
            $pessoa->estado_civil = $request->input('estado_civil');
            $pessoa->save();

            if ($request->has('organizacao')) {
                foreach ($request->input('organizacao') as $chave => $organizacao) {
                    $experiencia = new Experiencia();
                    $experiencia->organizacao = $organizacao;
                    $experiencia->cargo = $request->input('cargo.'.$chave);
                    $experiencia->inicio = $request->input('inicio.'.$chave);
                    $experiencia->fim = $request->input('fim.'.$chave);
                    $pessoa->experiencias()->save($experiencia);
                }
            }

            if ($request->has('instituicao')) {
                foreach ($request->input('instituicao') as $chave => $instituicao) {
                    $formacao = new Formacao();
                    $formacao->instituicao = $instituicao;
                    $formacao->curso = $request->input('curso.'.$chave);
                    $formacao->situacao = $request->input('situacao.'.$chave);
                    $pessoa->formacoes()->save($formacao);
                }
            }
        } else {
            $pessoa->nome = $request->input('nome');
            $pessoa->nascimento = $request->input('nascimento');
            $pessoa->cpf = $request->input('cpf');
            $pessoa->telefone = $request->input('telefone');
            $pessoa->email = $request->input('email');
            $pessoa->grau_ensino = $request->input('grau_ensino');
            $pessoa->municipio_id = $request->input('municipio_id');
            $pessoa->estado_civil = $request->input('estado_civil');
            $pessoa->formacoes()->delete();
            $pessoa->experiencias()->delete();

            if ($request->has('organizacao')) {
                foreach ($request->input('organizacao') as $chave => $organizacao) {
                    $experiencia = new Experiencia();
                    $experiencia->organizacao = $organizacao;
                    $experiencia->cargo = $request->input('cargo.'.$chave);
                    $experiencia->inicio = $request->input('inicio.'.$chave);
                    $experiencia->fim = $request->input('fim.'.$chave);
                    $pessoa->experiencias()->save($experiencia);
                }
            }

            if ($request->has('instituicao')) {
                foreach ($request->input('instituicao') as $chave => $instituicao) {
                    $formacao = new Formacao();
                    $formacao->instituicao = $instituicao;
                    $formacao->curso = $request->input('curso.'.$chave);
                    $formacao->situacao = $request->input('situacao.'.$chave);
                    $pessoa->formacoes()->save($formacao);
                }
            }

            $pessoa->save();
        }

        DB::commit();
        Cookie::queue('pagina', 'formulario.edit');

        return $this->show($pessoa->id)->with('sucesso', 'Dados salvos com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pessoa = Pessoa::with(['experiencias', 'formacoes'])->find($id);

        foreach ($pessoa->getAttributes() as $chave => $valor) {
            session(['_old_input.'.$chave => $valor]);
        }

        foreach ($pessoa->formacoes as $chave => $formacao) {
            foreach ($formacao->getAttributes() as $c => $valor) {
                session(["_old_input.$c.$chave" => $valor]);
            }
        }

        foreach ($pessoa->experiencias as $chave => $experiencia) {
            foreach ($experiencia->getAttributes() as $c => $valor) {
                session(["_old_input.$c.$chave" => $valor]);
            }
        }

        Cookie::queue('pagina', 'formulario.edit');

        return redirect(route('formulario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public static function buscar(Request $request)
    {
        Cookie::queue('pagina', 'busca');
        $busca = $request->input('busca');

        if (empty($busca)) {
            Cookie::forget('termo');

            return view('buscaVagas');
        }

        $resultados = Vaga::with(['empresa', 'empresa.municipio', 'empresa.municipio.estado']);
        $cargos = Vaga::select('cargo')->distinct();
        $empresas = Empresa::select('razao_social')->distinct();

        if (0 === strpos($busca, 'empresa_')) {
            $resultados = $resultados->where('empresa_id', substr($busca, 8));
            $empresas = $empresas->where('id', '<>', substr($busca, 8));
        } elseif (0 === strpos($busca, 'cargo_')) {
            $resultados = $resultados->where('cargo', '~*', substr($busca, 6));
            $cargos = $cargos->where('cargo', '<>', substr($busca, 6));
        } else {
            $resultados = $resultados->where(function ($query) use ($busca) {
                $query->where('descricao', '~*', $busca);
            });
        }

        $resultados = $resultados->get();
        $empresas = $empresas->pluck('razao_social');
        $cargos = $cargos->pluck('cargo');

        Cookie::queue('termo', $busca);

        return view('resultadosVagas', compact('resultados', 'busca', 'empresas', 'cargos'));
    }

    public function detalhes(int $id)
    {
        $pessoa = Pessoa::with(['formacoes', 'experiencias', 'municipio', 'municipio.estado'])->find($id);

        return view('detalhes', compact('pessoa'));
    }

    public function inscrever(Request $request, int $id)
    {
        $inscricao = Inscricao::firstOrCreate([
            'vaga_id' => $id,
            'pessoa_id' => $request->cookie('pessoa'),
        ]);

        if ( $inscricao->wasRecentlyCreated )
            return response('Inscrição realizada com sucesso', 201);

        return response('Inscrição existente', 200);
    }
}

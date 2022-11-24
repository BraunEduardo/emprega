<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Experiencia;
use App\Formacao;
use App\Http\Requests\EmpresaRequest;
use App\Pessoa;
use App\Services\ChecarEmpresa;
use App\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checar(Request $request, ChecarEmpresa $checarEmpresa)
    {
        $dados = $request->only(['cnpj', 'razao_social']);
        $empresa = $checarEmpresa->executar($dados);

        if (null === $empresa) {
            foreach ($dados as $chave => $valor) {
                session(['_old_input.'.$chave => $valor]);
            }

            return redirect(route('formEmpresa'));
        } else {
            Cookie::queue('pessoa', $empresa->id, 864000);
            Cookie::queue('tpessoa', 'empresa', 864000);

            return $this->show($empresa->id);
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
        Cookie::queue('pagina', 'cadEmpresa');

        return view('cadEmpresa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario()
    {
        return view('formEmpresa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function salvar(EmpresaRequest $request, ChecarEmpresa $checarEmpresa)
    {
        DB::beginTransaction();
        $empresa = $checarEmpresa->executar($request->only(['cnpj', 'razao_social']));

        if (null === $empresa) {
            $empresa = new Empresa();
            $empresa->razao_social = $request->input('razao_social');
            $empresa->cpf = $request->input('cpf');
            $empresa->telefone = $request->input('telefone');
            $empresa->email = $request->input('email');
            $empresa->municipio_id = $request->input('municipio_id');
            $empresa->save();

            if ($request->has('cargo')) {
                foreach ($request->input('cargo') as $chave => $cargo) {
                    $vaga = new Vaga();
                    $vaga->cargo = $cargo;
                    $vaga->remuneracao = $request->input('remuneracao.'.$chave);
                    $vaga->descricao = $request->input('descricao.'.$chave);
                    $empresa->vagas()->save($vaga);
                }
            }
        } else {
            $empresa->razao_social = $request->input('razao_social');
            $empresa->cnpj = $request->input('cnpj');
            $empresa->telefone = $request->input('telefone');
            $empresa->email = $request->input('email');
            $empresa->municipio_id = $request->input('municipio_id');
            $empresa->vagas()->delete();

            if ($request->has('cargo')) {
                foreach ($request->input('cargo') as $chave => $cargo) {
                    $vaga = new Vaga();
                    $vaga->cargo = $cargo;
                    $vaga->remuneracao = $request->input('remuneracao.'.$chave);
                    $vaga->descricao = $request->input('descricao.'.$chave);
                    $empresa->vagas()->save($vaga);
                }
            }

            $empresa->save();
        }

        DB::commit();
        Cookie::queue('pagina', 'formEmpresa.edit');

        return $this->show($empresa->id)->with('sucesso', 'Dados salvos com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $empresa = Empresa::with(['vagas'])->find($id);

        foreach ($empresa->getAttributes() as $chave => $valor) {
            session(['_old_input.'.$chave => $valor]);
        }

        foreach ($empresa->vagas as $chave => $vaga) {
            foreach ($vaga->toArray() as $c => $valor) {
                session(["_old_input.$c.$chave" => $valor]);
            }
        }

        Cookie::queue('pagina', 'formEmpresa.edit');

        return redirect(route('formEmpresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function buscar(Request $request)
    {
        Cookie::queue('pagina', 'busca');
        $busca = $request->input('busca');

        if (empty($busca)) {
            Cookie::forget('termo');

            return view('busca');
        }

        $resultados = Pessoa::with(['formacoes', 'experiencias', 'municipio', 'municipio.estado']);
        $cursos = Formacao::select('curso')->distinct();
        $cargos = Experiencia::select('cargo')->distinct();

        if (0 === strpos($busca, 'curso_')) {
            $resultados = $resultados->whereExists(function ($query) use ($busca) {
                $query->select(DB::raw(1))
                        ->from('formacoes')
                        ->where('formacoes.curso', '=', substr($busca, 6))
                        ->whereRaw('pessoas.id = formacoes.pessoa_id');
            });
            $cursos = $cursos->where('curso', '<>', substr($busca, 6));
        } elseif (0 === strpos($busca, 'cargo_')) {
            $resultados = $resultados->whereExists(function ($query) use ($busca) {
                $query->select(DB::raw(1))
                        ->from('experiencias')
                        ->where('experiencias.cargo', '=', substr($busca, 6))
                        ->whereRaw('pessoas.id = experiencias.pessoa_id');
            });
            $cargos = $cargos->where('cargo', '<>', substr($busca, 6));
        } else {
            $resultados = $resultados->where(function ($query) use ($busca) {
                $query->where('nome', '~*', $busca)
                        ->orWhere('email', '~*', $busca);
            });
        }

        $resultados = $resultados->get();
        $cursos = $cursos->pluck('curso');
        $cargos = $cargos->pluck('cargo');

        Cookie::queue('termo', $busca);

        return view('resultados', compact('resultados', 'busca', 'cursos', 'cargos'));
    }

    public function detalhes(int $id)
    {
        $empresa = Empresa::with(['vagas', 'municipio', 'municipio.estado'])->find($id);

        return view('detEmpresa', compact('empresa'));
    }

    public function inscritos(int $id)
    {
        $inscritos = Pessoa::join('inscricoes', function($join) use ($id) {
            $join->on('inscricoes.pessoa_id', '=', 'pessoas.id')
                ->where('inscricoes.vaga_id', '=', $id);
        })->with(['formacoes', 'experiencias', 'municipio', 'municipio.estado'])->get();
        $vaga = Vaga::find($id);

        return view('inscritos', compact('inscritos', 'vaga'));
    }
}

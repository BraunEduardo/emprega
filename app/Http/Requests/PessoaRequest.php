<?php

namespace App\Http\Requests;

use App\Formacao;
use App\Pessoa;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string',
            'nascimento' => 'required|date|before:'.Carbon::now()->format('Y-m-d'),
            'cpf' => 'required|string|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
            'telefone' => 'required|string|regex:/^\(\d{2}\) \d{4,5}-\d{4}$/',
            'email' => 'required|string|email',
            'grau_ensino' => 'required|string|in:'.implode(',', Pessoa::GRAUS_ENSINO),
            'municipio_id' => 'required|integer|exists:municipios,id',
            'estado_civil' => 'required|string|in:'.implode(',', Pessoa::ESTADOS_CIVIS),
            'instituicao' => 'sometimes|array',
            'curso' => 'sometimes|array',
            'situacao' => 'sometimes|array',
            'situacao.*' => 'sometimes|in:'.implode(',', Formacao::SITUACOES),
            'aceite' => 'accepted',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'nascimento' => 'Nascimento',
            'cpf' => 'CPF',
            'telefone' => 'Telefone',
            'email' => 'E-mail',
            'grau_ensino' => 'Grau de ensino',
            'municipio_id' => 'Cidade',
            'estado_civil' => 'Estado civil',
            'situacao.*' => 'Situação',
        ];
    }

    public function messages()
    {
        return [
            'aceite.accepted' => 'É necessário aceitar concordar com a utilização de seus dados para prosseguir.',
        ];
    }
}

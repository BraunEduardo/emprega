<?php

namespace App\Http\Requests;

use App\Formacao;
use App\Empresa;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'razao_social' => 'required|string',
            'cnpj' => 'required|string|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/',
            'telefone' => 'required|string|regex:/^\(\d{2}\) \d{4,5}-\d{4}$/',
            'email' => 'required|string|email',
            'municipio_id' => 'required|integer|exists:municipios,id',
            'aceite' => 'accepted',
        ];
    }

    public function attributes()
    {
        return [
            'razao_social' => 'Razão social',
            'cnpj' => 'CPF',
            'telefone' => 'Telefone',
            'email' => 'E-mail',
            'municipio_id' => 'Município',
        ];
    }

    public function messages()
    {
        return [
            'aceite.accepted' => 'É necessário aceitar concordar com a utilização de seus dados para prosseguir.',
        ];
    }
}

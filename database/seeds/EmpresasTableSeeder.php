<?php

use App\Empresa;
use App\Vaga;
use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresas = [
            [
                'razao_social' => 'Conpasul',
                'cnpj' => '00.000.000/0000-00',
                'telefone' => '(51) 12345-4353',
                'email' => 'contato@conpasul.com.br',
                'municipio_id' => 4311403,
                'cargo' => [
                    'Auxiliar administrativo',
                    'Analista de desenvolvimento de sistemas',
                ],
                'remuneracao' => [
                    843.77,
                    1684.40,
                    843.77,
                    1684.40,
                    843.77,
                    1684.40,
                ],
                'descricao' => [
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                    'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                    'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                    'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                ],
            ],
            [
                'razao_social' => 'Lavanderia Lavanda',
                'cnpj' => '00.000.000/0000-01',
                'telefone' => '(16) 94366-1212',
                'email' => 'adm@lavlaveda.com.br',
                'municipio_id' => 1713700,
                'cargo' => [
                    'Gerente',
                    'Consultor financeiro',
                ],
                'remuneracao' => [
                    5350.76,
                    3102.10,
                ],
                'descricao' => [
                    'Dolor magna eget est lorem ipsum dolor sit amet consectetur. Nec tincidunt praesent semper feugiat nibh sed pulvinar proin. Orci phasellus egestas tellus rutrum tellus pellentesque.',
                    'Commodo elit at imperdiet dui accumsan sit amet nulla.',
                ],
            ],
        ];

        foreach ($empresas as $dados_empresa) {
            $empresa = new Empresa();
            $empresa->razao_social = $dados_empresa['razao_social'];
            $empresa->cnpj = $dados_empresa['cnpj'];
            $empresa->telefone = $dados_empresa['telefone'];
            $empresa->email = $dados_empresa['email'];
            $empresa->municipio_id = $dados_empresa['municipio_id'];
            $empresa->save();

            if (isset($dados_empresa['cargo'])) {
                foreach ($dados_empresa['cargo'] as $chave => $cargo) {
                    $vaga = new Vaga();
                    $vaga->cargo = $cargo;
                    $vaga->remuneracao = $dados_empresa['remuneracao'][$chave];
                    $vaga->descricao = $dados_empresa['descricao'][$chave];
                    $empresa->vagas()->save($vaga);
                }
            }
        }
    }
}

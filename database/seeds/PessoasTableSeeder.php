<?php

use App\Experiencia;
use App\Formacao;
use App\Pessoa;
use Illuminate\Database\Seeder;

class PessoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pessoas = [
            [
                'nome' => 'Eduardo Braun',
                'nascimento' => '1999-12-19',
                'cpf' => '000.000.000-00',
                'telefone' => '(51) 12345-4323',
                'email' => 'eduardobraun@edu.unisinos.br',
                'grau_ensino' => 'Superior incompleto',
                'municipio_id' => 4311403,
                'estado_civil' => 'Solteiro',
                'organizacao' => [
                    'Conpasul',
                    'Solis Soluções em Tecnologia',
                ],
                'cargo' => [
                    'Auxiliar administrativo',
                    'Analista de desenvolvimento de sistemas',
                ],
                'inicio' => [
                    '2017',
                    '2017',
                ],
                'fim' => [
                    '2017',
                    '2022',
                ],
                'instituicao' => [
                    'EEEPE',
                    'Unisinos',
                ],
                'curso' => [
                    'Técnico em informática',
                    'Sistemas para internet',
                ],
                'situacao' => [
                    'Completo',
                    'Incompleto',
                ],
            ],
            [
                'nome' => 'Rafael Silveira',
                'nascimento' => '1984-11-09',
                'cpf' => '000.000.000-01',
                'telefone' => '(55) 94466-1212',
                'email' => 'teste@hotmail.com.br',
                'grau_ensino' => 'Superior completo',
                'municipio_id' => 1713700,
                'estado_civil' => 'Casado',
                'organizacao' => [
                    'Lavanderia Lavanda',
                    'Miranda Investimentos',
                ],
                'cargo' => [
                    'Gerente',
                    'Consultor financeiro',
                ],
                'inicio' => [
                    '2005',
                    '2014',
                ],
                'fim' => [
                    '2013',
                    '2020',
                ],
                'instituicao' => [
                    'Uniritter',
                ],
                'curso' => [
                    'Ciências econômicas',
                ],
                'situacao' => [
                    'Completo',
                ],
            ],
            [
                'nome' => 'Paulo Morgan Rebouças',
                'nascimento' => '1991-06-17',
                'cpf' => '000.000.000-02',
                'telefone' => '(45) 96331-7711',
                'email' => 'paulo@morganreboucas.com.br',
                'grau_ensino' => 'Superior completo',
                'municipio_id' => 1300631,
                'estado_civil' => 'Divorciado',
                'organizacao' => [
                    'Reparos Nogueira',
                    'C&D Reformas',
                ],
                'cargo' => [
                    'Pedreiro',
                    'Mestre de obra',
                ],
                'inicio' => [
                    '2013',
                    '2018',
                ],
                'fim' => [
                    '2018',
                    '2021',
                ],
                'instituicao' => [
                    'Instituo Mix',
                ],
                'curso' => [
                    'Técnico em edificações',
                ],
                'situacao' => [
                    'Completo',
                ],
            ],
        ];

        foreach ($pessoas as $dados_pessoa) {
            $pessoa = new Pessoa();
            $pessoa->nome = $dados_pessoa['nome'];
            $pessoa->nascimento = $dados_pessoa['nascimento'];
            $pessoa->cpf = $dados_pessoa['cpf'];
            $pessoa->telefone = $dados_pessoa['telefone'];
            $pessoa->email = $dados_pessoa['email'];
            $pessoa->grau_ensino = $dados_pessoa['grau_ensino'];
            $pessoa->municipio_id = $dados_pessoa['municipio_id'];
            $pessoa->estado_civil = $dados_pessoa['estado_civil'];
            $pessoa->save();

            if (isset($dados_pessoa['organizacao'])) {
                foreach ($dados_pessoa['organizacao'] as $chave => $organizacao) {
                    $experiencia = new Experiencia();
                    $experiencia->organizacao = $organizacao;
                    $experiencia->cargo = $dados_pessoa['cargo'][$chave];
                    $experiencia->inicio = $dados_pessoa['inicio'][$chave];
                    $experiencia->fim = $dados_pessoa['fim'][$chave];
                    $pessoa->experiencias()->save($experiencia);
                }
            }

            if (isset($dados_pessoa['instituicao'])) {
                foreach ($dados_pessoa['instituicao'] as $chave => $instituicao) {
                    $formacao = new Formacao();
                    $formacao->instituicao = $instituicao;
                    $formacao->curso = $dados_pessoa['curso'][$chave];
                    $formacao->situacao = $dados_pessoa['situacao'][$chave];
                    $pessoa->formacoes()->save($formacao);
                }
            }
        }
    }
}

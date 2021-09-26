<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source_file = database_path('sources/estados.json');
        $content = file_get_contents($source_file);
        $estados = json_decode($content);

        foreach ($estados as $id => $estado) {
            DB::table('estados')->insert([
                'id' => $id,
                'nome' => $estado->nome,
                'sigla' => $estado->sigla,
            ]);
        }
    }
}

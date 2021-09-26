<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source_file = database_path('sources/municipios.json');
        $content = file_get_contents($source_file);
        $municipios = json_decode($content);

        foreach ($municipios as $id => $nome) {
            $estado_id = substr($id, 0, 2);
            DB::table('municipios')->insert([
                'id' => $id,
                'nome' => $nome,
                'estado_id' => $estado_id,
            ]);
        }
    }
}

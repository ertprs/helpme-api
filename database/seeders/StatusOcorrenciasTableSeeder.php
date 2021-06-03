<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOcorrenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusOcorrencias = array([
            "id" => 1,
            "status" => "Novo",
            "descricao" => "Denúncia criada recentemente"
        ], [
            "id" => 2,
            "status" => "Aceita (Em Processamento)",
            "descricao" => "Denúncia recebida pelo agente"
        ], [
            "id" => 3,
            "status" => "Arquivada",
            "descricao" => "Denúncia finalizada e arquivada"
        ]);

        for ($i = 0; $i < sizeOf($statusOcorrencias); $i++) {
            DB::table('status_ocorrencias')->insert($statusOcorrencias[$i]);
        }
    }
}

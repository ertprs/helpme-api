<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusTicket = array([
            "id" => 1,
            "status" => "Novo"
        ], [
            "id" => 2,
            "status" => "Em atendimento"
        ], [
            "id" => 3,
            "status" => "Pendente"
        ], [
            "id" => 4,
            "status" => "Solucionado"
        ], [
            "id" => 5,
            "status" => "Cancelado"
        ]);

        for ($i = 0; $i < sizeOf($statusTicket); $i++) {
            DB::table('status_tickets')->insert($statusTicket[$i]);
        }
    }
}

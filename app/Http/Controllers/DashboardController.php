<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard() {

        /**
         * Retorna a quantidade de tickets em aberto
         */
        $ticketsOpen = DB::select("SELECT * FROM tickets WHERE status_id != 4 and status_id != 5");

        /**
         * Retorna a quantidade de chamados abertos no mês atual
         */
        $ticketsInMonth = DB::select("SELECT * FROM tickets WHERE EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM CURRENT_DATE)");

        /**
         * Retorna a quantidade de tickets pendentes
         */
        $ticketsPending = DB::select("SELECT * FROM tickets WHERE status_id = 3");

        /**
         * Retorna a quantidade de tickets em andamento
         */
        $ticketsInProgress = DB::select("SELECT * FROM tickets WHERE status_id = 2");

        /**
         * Retorna a quantidade de tickets solucionados
         */
        $ticketsFinish = DB::select("SELECT * FROM tickets WHERE status_id = 4");

        $result = [
            'ticketsOpen' => [
                'qtd' => sizeOf($ticketsOpen),
                'data' => $ticketsOpen,
            ],
            'ticketsInMonth' => [
                'qtd' => sizeOf($ticketsInMonth),
                'data' => $ticketsInMonth,
            ],
            'ticketsPending' => [
                'qtd' => sizeOf($ticketsPending),
                'data' => $ticketsPending,
            ],
            'ticketsInProgress' => [
                'qtd' => sizeOf($ticketsInProgress),
                'data' => $ticketsInProgress,
            ],
            'ticketsFinish' => [
                'qtd' => sizeOf($ticketsFinish),
                'data' => $ticketsFinish,
            ]
        ];

        return response(['data' => $result], 200);
    }


}

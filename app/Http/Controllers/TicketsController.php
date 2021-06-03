<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{

    public function index() {

        $tickets = DB::select("SELECT t.id, t.user_id, u.first_name, u.last_name, t.client_id, c.first_name client_first_name, c.last_name client_last_name, t.status_id, st.status, t.title, t.description, to_char(t.created_at, 'DD/MM/YYYY HH24:MI:SS') created_at
                               FROM tickets t
                               LEFT JOIN users u ON t.user_id = u.id
                               LEFT JOIN clients c ON t.client_id = c.id
                               LEFT JOIN status_tickets st ON t.status_id = st.id
                               ORDER BY t.id DESC");

        return response(['total' => sizeof($tickets), 'data' => $tickets], 200);
    }

    public function new (Request $request) {

        try {
            $ticket = Ticket::create([
                'user_id' => $request->user_id,
                'client_id' => $request->client_id,
                'status_id' => $request->status_id,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return response(['status' => 'success', 'message' => 'Ticket criado com sucesso!', 'data' => $ticket], 201);
        } catch(Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }

    }

    public function update(Request $request, $id) {

        $request = $request->all();
        if(!$ticket = Ticket::find($id)) {

            return response(["status" => "error", "message" => "Ticket não encontrado!"], 500);

        } else {

            try {
                $ticket->update($request);

                return response(['status' => 'success', 'message' => 'Ticket atualizado com sucesso!', 'data' => $ticket], 201);
            } catch(Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }

        }

    }

    public function remove(Ticket $ticket, $id) {

        if(!$ticket = Ticket::find($id)) {

            return response(["status" => "error", "message" => "Ticket não encontrado!"], 500);

        } else {

            try {
                $ticket->delete();

                return response([ "status" => "success", "message" => "Ticket removido com sucesso!" ], 200);
            } catch(Exception $err) {
                return response([ "error" => "error", "message" => $err->getMessage()], 500);
            }
        }

    }

}

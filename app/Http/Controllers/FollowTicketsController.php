<?php

namespace App\Http\Controllers;

use App\Models\FollowTicket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowTicketsController extends Controller
{

    public function index()
    {
        $followTicket = FollowTicket::all()->sortBy("id");

        return response(['total' => sizeof($followTicket), 'data' => $followTicket], 200);
    }

    public function show($id) {

        $followTicket = DB::select("SELECT ft.id, ft.user_id, u.username, u.first_name, u.last_name, ft.status_id, st.status, t.title ticket_title,  ft.description, to_char(ft.created_at, 'DD/MM/YYYY HH24:MI:SS') created_at
                               FROM follow_tickets ft
                               LEFT JOIN users u ON ft.user_id = u.id
                               LEFT JOIN tickets t ON ft.ticket_id = t.id
                               LEFT JOIN status_tickets st ON ft.status_id = st.id
                               WHERE ft.ticket_id = $id
                               ORDER BY ft.id ASC");

        return response(['total' => sizeof($followTicket),'data' => $followTicket], 200);
    }

    public function new(Request $request)
    {
        $ticketId = $request['ticket_id'];

        //Valida se o chamado existe
        $validation = DB::select("SELECT * FROM tickets WHERE id = $ticketId");

        if ($validation) {

            try {
                $userId = $request->user_id;
                $ticketId = $request->ticket_id;
                $statusId = $request->status_id;
                $description = $request->description;

                $followTicket = FollowTicket::create([
                    'user_id' => $userId,
                    'ticket_id' => $ticketId,
                    'status_id' => $statusId,
                    'description' => $description
                ]);

                //Atualiza o ticket com o novo status
                DB::update("UPDATE tickets SET status_id = $statusId WHERE id = $ticketId");

                return response(['status' => 'success', 'message' => 'Acompanhamento criado com sucesso!', 'data' => $followTicket], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }

        } else {
            return response(['status' => 'error', 'message' => "Ticket não foi encontrado!"], 500);
        }

    }

    public function update(Request $request, $id)
    {

        $request = $request->all();
        if (!$followTicket = FollowTicket::find($id)) {

            return response(["status" => "error", "message" => "Acompanhamento não encontrado!"], 500);
        } else {

            try {
                $followTicket->update($request);

                return response(['status' => 'success', 'message' => 'Acompanhamento atualizado com sucesso!', 'data' => $followTicket], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }
        }
    }

    public function remove(FollowTicket $followTicket, $id)
    {

        if (!$followTicket = FollowTicket::find($id)) {

            return response(["status" => "error", "message" => "Acompanhamento não encontrado!"], 500);

        } else {

            try {
                $followTicket->delete();

                return response(["status" => "success", "message" => "Acompanhamento removido com sucesso!"], 200);
            } catch (Exception $err) {
                return response(["error" => "error", "message" => $err->getMessage()], 500);
            }

        }
    }

}

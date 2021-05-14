<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;

class TicketsController extends Controller
{

    public function index() {
        $tickets = Ticket::all();

        return response(['total' => sizeof($tickets), 'data' => $tickets], 200);
    }

    public function new (Request $request) {

        try {
            $ticket = Ticket::create([
                'user_id' => $request->user_id,
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

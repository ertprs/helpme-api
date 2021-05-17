<?php

namespace App\Http\Controllers;

use App\Models\StatusTicket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusTicketController extends Controller
{
    public function index()
    {
        $statusTicket = DB::select("SELECT * FROM status_tickets ORDER BY id ASC");

        return response(['total' => sizeof($statusTicket), 'data' => $statusTicket], 200);
    }

    public function new(Request $request)
    {

        try {
            $statusTicket = StatusTicket::create([
                'status' => $request->status
            ]);

            return response(['status' => 'success', 'message' => 'Status criado com sucesso!', 'data' => $statusTicket], 201);
        } catch (Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }

    }

    public function update(Request $request, $id)
    {

        $request = $request->all();
        if (!$statusTicket = StatusTicket::find($id)) {

            return response(["status" => "error", "message" => "Status não encontrado!"], 500);
        } else {

            try {
                $statusTicket->update($request);

                return response(['status' => 'success', 'message' => 'Status atualizado com sucesso!', 'data' => $statusTicket], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }
        }
    }

    public function remove(StatusTicket $statusTicket, $id)
    {

        if (!$statusTicket = StatusTicket::find($id)) {

            return response(["status" => "error", "message" => "Status não encontrado!"], 500);

        } else {

            $validation = DB::select("SELECT * FROM tickets WHERE status_id = $id");

            if ($validation) {

                return response(["status" => "error", "message" => "Status não pode ser excluído pois tem tickets vinculados!"], 500);

            } else {

                try {
                    $statusTicket->delete();

                    return response(["status" => "success", "message" => "Status removido com sucesso!"], 200);
                } catch (Exception $err) {
                    return response(["error" => "error", "message" => $err->getMessage()], 500);
                }

            }
        }
    }
}

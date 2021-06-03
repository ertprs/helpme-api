<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DenúnciasController extends Controller
{

    public function index() {

        $denuncias = DB::select("SELECT t.id, t.user_id, u.first_name, u.last_name, t.client_id, c.first_name client_first_name, c.last_name client_last_name, t.status_id, st.status, t.title, t.description, to_char(t.created_at, 'DD/MM/YYYY HH24:MI:SS') created_at
                               FROM tickets t
                               LEFT JOIN users u ON t.user_id = u.id
                               LEFT JOIN clients c ON t.client_id = c.id
                               LEFT JOIN status_tickets st ON t.status_id = st.id
                               ORDER BY t.id DESC");

        return response(['total' => sizeof($denuncias), 'data' => $denuncias], 200);
    }

    public function new (Request $request) {

        try {
            $denuncia = Denuncia::create([
                'crime_id' => $request->uscrime_ider_id,
                'pessoa_id' => $request->pessoa_id,
                'status_id' => $request->status_id,
                'datahora_ocorrencia' => $request->datahora_ocorrencia,
                'descricao_detalhada' => $request->descricao_detalhada
            ]);

            return response(['status' => 'success', 'message' => 'Denúncia criada com sucesso!', 'data' => $denuncia], 201);
        } catch(Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }

    }

    public function update(Request $request, $id) {

        $request = $request->all();
        if(!$denuncia = Denuncia::find($id)) {

            return response(["status" => "error", "message" => "Denúncia não encontrada!"], 500);

        } else {

            try {
                $denuncia->update($request);

                return response(['status' => 'success', 'message' => 'Denúncia atualizada com sucesso!', 'data' => $denuncia], 201);
            } catch(Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }

        }

    }

    public function remove(Denuncia $denuncia, $id) {

        if(!$denuncia = Denuncia::find($id)) {

            return response(["status" => "error", "message" => "Denúncia não encontrada!"], 500);

        } else {

            try {
                $denuncia->delete();

                return response([ "status" => "success", "message" => "Denúncia removida com sucesso!" ], 200);
            } catch(Exception $err) {
                return response([ "error" => "error", "message" => $err->getMessage()], 500);
            }
        }

    }

}

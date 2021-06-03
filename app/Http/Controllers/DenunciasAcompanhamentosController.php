<?php

namespace App\Http\Controllers;

use App\Models\DenunciasAcompanhamento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DenunciasAcompanhamentosController extends Controller
{

    public function index()
    {
        $denunciasAcompanhamento = DenunciasAcompanhamento::all()->sortBy("id");

        return response(['total' => sizeof($denunciasAcompanhamento), 'data' => $denunciasAcompanhamento], 200);
    }

    public function show($id) {

        $denunciasAcompanhamento = DB::select("SELECT ft.id, ft.user_id, u.username, u.first_name, u.last_name, ft.status_id, st.status, t.title ticket_title,  ft.description, to_char(ft.created_at, 'DD/MM/YYYY HH24:MI:SS') created_at
                               FROM follow_tickets ft
                               LEFT JOIN users u ON ft.user_id = u.id
                               LEFT JOIN tickets t ON ft.ticket_id = t.id
                               LEFT JOIN status_tickets st ON ft.status_id = st.id
                               WHERE ft.ticket_id = $id
                               ORDER BY ft.id ASC");

        return response(['total' => sizeof($denunciasAcompanhamento),'data' => $denunciasAcompanhamento], 200);
    }

    public function new(Request $request)
    {
        $denunciaId = $request['denuncia_id'];

        //Valida se o chamado existe
        $validation = DB::select("SELECT * FROM denuncias WHERE id = $denunciaId");

        if ($validation) {

            try {
                $agente_id = $request->agente_id;
                $denuncia_id = $request->denuncia_id;
                $status_id = $request->status_id;
                $descricao_acompamnhamento = $request->descricao_acompamnhamento;

                $denunciasAcompanhamento = DenunciasAcompanhamento::create([
                    'agente_id' => $agente_id,
                    'denuncia_id' => $denuncia_id,
                    'status_id' => $status_id,
                    'descricao_acompamnhamento' => $descricao_acompamnhamento
                ]);

                //Atualiza o ticket com o novo status
                DB::update("UPDATE denuncias SET status_id = $status_id WHERE id = $denuncia_id");

                return response(['status' => 'success', 'message' => 'Acompanhamento criado com sucesso!', 'data' => $denunciasAcompanhamento], 201);
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
        if (!$denunciasAcompanhamento = DenunciasAcompanhamento::find($id)) {

            return response(["status" => "error", "message" => "Acompanhamento não encontrado!"], 500);
        } else {

            try {
                $denunciasAcompanhamento->update($request);

                return response(['status' => 'success', 'message' => 'Acompanhamento atualizado com sucesso!', 'data' => $denunciasAcompanhamento], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }
        }
    }

    public function remove(DenunciasAcompanhamento $denunciasAcompanhamento, $id)
    {

        if (!$denunciasAcompanhamento = DenunciasAcompanhamento::find($id)) {

            return response(["status" => "error", "message" => "Acompanhamento não encontrado!"], 500);

        } else {

            try {
                $denunciasAcompanhamento->delete();

                return response(["status" => "success", "message" => "Acompanhamento removido com sucesso!"], 200);
            } catch (Exception $err) {
                return response(["error" => "error", "message" => $err->getMessage()], 500);
            }

        }
    }

}

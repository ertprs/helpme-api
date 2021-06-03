<?php

namespace App\Http\Controllers;

use App\Models\StatusOcorrencia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusOcorrenciaController extends Controller
{
    public function index()
    {
        $statusOcorrencias = DB::select("SELECT * FROM status_ocorrencias ORDER BY id ASC");

        return response(['total' => sizeof($statusOcorrencias), 'data' => $statusOcorrencias], 200);
    }

    public function new(Request $request)
    {

        try {
            $statusOcorrencias = StatusOcorrencia::create([
                'status' => $request->status
            ]);

            return response(['status' => 'success', 'message' => 'Status criado com sucesso!', 'data' => $statusOcorrencias], 201);
        } catch (Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }

    }

    public function update(Request $request, $id)
    {

        $request = $request->all();
        if (!$statusOcorrencias = StatusOcorrencia::find($id)) {

            return response(["status" => "error", "message" => "Status não encontrado!"], 500);
        } else {

            try {
                $statusOcorrencias->update($request);

                return response(['status' => 'success', 'message' => 'Status atualizado com sucesso!', 'data' => $statusOcorrencias], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }
        }
    }

    public function remove(StatusOcorrencia $statusOcorrencias, $id)
    {

        if (!$statusOcorrencias = StatusOcorrencia::find($id)) {

            return response(["status" => "error", "message" => "Status não encontrado!"], 500);

        } else {

            $validation = DB::select("SELECT * FROM denuncias WHERE status_id = $id");

            if ($validation) {

                return response(["status" => "error", "message" => "Status não pode ser excluído pois tem uma ou mais denúncias vinculados!"], 500);

            } else {

                try {
                    $statusOcorrencias->delete();

                    return response(["status" => "success", "message" => "Status removido com sucesso!"], 200);
                } catch (Exception $err) {
                    return response(["error" => "error", "message" => $err->getMessage()], 500);
                }

            }
        }
    }
}

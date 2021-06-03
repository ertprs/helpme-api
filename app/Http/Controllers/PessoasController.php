<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoasController extends Controller
{
    public function index()
    {
        $pessoas = DB::select("SELECT * FROM pessoas ORDER BY id ASC");

        return response(['total' => sizeof($pessoas), 'data' => $pessoas], 200);
    }

    public function new(Request $request)
    {

        try {
            $pessoas = Pessoa::create([
                'status' => $request->status
            ]);

            return response(['status' => 'success', 'message' => 'Pessoa cadastrada com sucesso!', 'data' => $pessoas], 201);
        } catch (Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }

    }

    public function update(Request $request, $id)
    {

        $request = $request->all();
        if (!$pessoas = Pessoa::find($id)) {

            return response(["status" => "error", "message" => "Pessoa não encontrado!"], 500);
        } else {

            try {
                $pessoas->update($request);

                return response(['status' => 'success', 'message' => 'Pessoa atualizada com sucesso!', 'data' => $pessoas], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }
        }
    }

    public function remove(Pessoa $pessoas, $id)
    {

        if (!$pessoas = Pessoa::find($id)) {

            return response(["status" => "error", "message" => "Pessoa não encontrada!"], 500);

        } else {

            $validation = DB::select("SELECT * FROM denuncias WHERE pessoa_id = $id");

            if ($validation) {

                return response(["status" => "error", "message" => "Pessoa não pode ser excluída pois tem uma ou mais denúncias vinculados!"], 500);

            } else {

                try {
                    $pessoas->delete();

                    return response(["status" => "success", "message" => "Pessoa removida com sucesso!"], 200);
                } catch (Exception $err) {
                    return response(["error" => "error", "message" => $err->getMessage()], 500);
                }

            }
        }
    }
}

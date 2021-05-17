<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller {
    public function index() {
        $clients = Client::all();

        return response(['total' => sizeof($clients), 'data' => $clients], 200);
    }

    public function new(Request $request) {

        try {
            $client = Client::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "phone" => $request->phone,
                "email" => $request->email,
                "cnpj_cpf" => $request->cnpj_cpf,
                "address" => $request->address,
                "state" => $request->state,
                "city" => $request->city,
                "cep" => $request->cep,
                "description" => $request->description,
                "status" => $request->status,
            ]);

            return response(['status' => 'success', 'message' => 'Cliente cadastrado com sucesso!', 'data' => $client], 201);
        } catch (Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }

    }

    public function update(Request $request, $id) {

        $request = $request->all();
        if(!$client = Client::find($id)) {

            return response(["status" => "error", "message" => "Cliente não encontrado!"], 500);

        } else {

            try {

                $client->update($request);

                return response(["status" => "success", "message" => "Cliente atualizado com sucesso!"], 200);
            } catch(Exception $err) {
                return response(["status" => "error", "message" => $err->getMessage()], 500);
            }

        }
    }

    public function remove(Client $client, $id) {

        if(!$client = Client::find($id)) {

            return response(["status" => "error", "message" => "Cliente não encontrado!"], 500);

        } else {

            try {
                $client->delete();

                return response([ "status" => "success", "message" => "Cliente removido com sucesso!" ], 200);
            } catch(Exception $err) {
                return response([ "error" => "error", "message" => $err->getMessage()], 500);
            }

        }

    }
}

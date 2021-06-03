<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class AgentesController extends Controller
{
    public function index()
    {
        $agentes =  DB::select("SELECT u.id, u.nome_agente, u.usuario, u.token, u.api_token
                    FROM agentes u
                    ORDER BY u.nome_agente ASC");

        return response(['data' => $agentes], 200);
    }

    public function new(Request $request)
    {

        $usuario = $request->usuario;

        $validation = DB::select("SELECT usuario from agentes WHERE usuario = '$usuario'");

        if (!$validation) {

            $header = [
                'alg' => 'HS256',
                'typ' => 'JWT'
            ];
            $header = json_encode($header);
            $header = base64_encode($header);

            $payload = [
                'iss' => 'cyberdenuncie',
                'name' => $usuario,
                'email' => "$usuario@cyberdenuncie.com.br"
            ];
            $payload = json_encode($payload);
            $payload = base64_encode($payload);

            $signature = hash_hmac('sha256', "$header.$payload", 'devEncLee848625@2021!~', true);
            $signature = base64_encode($signature);

            $jwt_token = "$header.$payload.$signature";

            $agente = Agente::create([
                "nome_agente" => $request->nome_agente,
                "usuario" => $request->usuario,
                "password" => md5($request->password),
                "token" => $jwt_token,
                // "api_token" => env('JWT_SECRET')
                "api_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzeXMiOiJDeWJlcmRlbnVuY2llIiwiZGVzYyI6IlNpc3RlbWEgZGUgR2VzdMOjbyBkZSBEZW7Dum5jaWFzIiwiY29tIjoiRW5jb2RlIERldiIsImRldiI6IkNsZWJlciBMZWUgZGEgUm9jaGEiLCJ0YXJnZXQiOiJEZW7Dum5jaWFzIiwicHNzIjoiZGV2RW5jTGVlODQ4NjI1QDIwMjEhfiJ9.ZrOrkb_xlPgDO6JROJV_pm21ikDjDF_JVFv04u8rTyQ"
            ]);

            return response(['status' => 'success', 'data' => $agente, 'message' => 'Agent created with success'], 201);
        } else {
            return response(['code' => '2008', 'status' => 'failure', 'message' => 'Agent already exists'], 409);
        }
    }

    public function update(Request $request, $id)
    {

        if (!$agente = Agente::find($id)) {

            return response(["status" => "error", "message" => "Usuário não encontrado!"], 500);
        } else {

            try {

                $password = $request->password;

                if ($request->password != "") {
                    $password = md5($request->password);
                } else {
                    $password = $agente->password;
                }

                $agente->update([
                    "nome_agente" => $request->nome_agente,
                    "usuario" => $request->usuario,
                    "password" => $password,
                    "status" => $request->status,
                    "notification" => $request->notification,
                ]);

                return response(["status" => "success", "message" => "Usuário alterado com sucesso!"], 200);
            } catch (Exception $err) {
                return response(["status" => "error", "message" => $err->getMessage()], 500);
            }
        }
    }


    public function remove(Agente $agente, $id)
    {


        if (!$agente = Agente::find($id)) {

            return response(["status" => "error", "message" => "Usuário não encontrado!"], 500);
        } else {

            try {
                $agente->delete();

                return response(["status" => "success", "message" => "Usuário removido com sucesso!"], 200);
            } catch (Exception $err) {
                return response(["error" => "error", "message" => $err->getMessage()], 500);
            }
        }
    }
}

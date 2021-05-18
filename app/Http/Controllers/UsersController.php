<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        $users =  DB::select("SELECT u.first_name, u.last_name, u.client_id, c.first_name client_first_name, c.last_name client_last_name, u.permission_id, p.permission, u.username, u.email, u.status, u.notification, u.token, u.api_token
                    FROM users u
                    LEFT JOIN clients c ON u.client_id = c.id
                    INNER JOIN permissions p ON u.permission_id = p.id
                    ORDER BY u.first_name ASC");

        return response(['data' => $users], 200);
    }

    public function new(Request $request)
    {

        $username = $request->username;
        $email = $request->email;

        $validation = DB::select("SELECT username, email from users WHERE username = '$username' and email = '$email'");

        if (!$validation) {

            $header = [
                'alg' => 'HS256',
                'typ' => 'JWT'
            ];
            $header = json_encode($header);
            $header = base64_encode($header);

            $payload = [
                'iss' => 'helpme',
                'name' => $request->username,
                'email' => $request->email
            ];
            $payload = json_encode($payload);
            $payload = base64_encode($payload);

            $signature = hash_hmac('sha256', "$header.$payload", 'devEncLee848625@2021!~', true);
            $signature = base64_encode($signature);

            $jwt_token = "$header.$payload.$signature";

            $user = User::create([
                "client_id" => $request->client_id,
                "permission_id" => $request->permission_id,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "username" => $request->username,
                "email" => $request->email,
                "password" => md5($request->password),
                "status" => $request->status,
                "notification" => $request->notification,
                "token" => $jwt_token,
                "api_token" => env('JWT_SECRET')
            ]);

            return response(['status' => 'success', 'data' => $user, 'message' => 'User created with success'], 201);
        } else {
            return response(['code' => '2008', 'status' => 'failure', 'message' => 'User already exists'], 409);
        }
    }

    public function update(Request $request, $id)
    {

        if (!$user = User::find($id)) {

            return response(["status" => "error", "message" => "Usuário não encontrado!"], 500);
        } else {

            try {

                $password = $request->password;

                if ($request->password != "") {
                    $password = md5($request->password);
                } else {
                    $password = $user->password;
                }

                $user->update([
                    "client_id" => $request->client_id,
                    "permission_id" => $request->permission_id,
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "username" => $request->username,
                    "email" => $request->email,
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


    public function remove(User $user, $id)
    {


        if (!$user = User::find($id)) {

            return response(["status" => "error", "message" => "Usuário não encontrado!"], 500);
        } else {

            try {
                $user->delete();

                return response(["status" => "success", "message" => "Usuário removido com sucesso!"], 200);
            } catch (Exception $err) {
                return response(["error" => "error", "message" => $err->getMessage()], 500);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function Login(Request $request) {

        $usuario = $request->usuario;
        $password = md5($request->password);

        $validation = DB::select("SELECT id, usuario, password, token from agentes WHERE (usuario = '$usuario') and password = '$password'");

        if ($validation) {

            $id = $validation[0]->id;

            $user = DB::select("SELECT id, nome_agente, usuario, token from agentes WHERE id = '$id'");

            $day = date(strtotime('+3 hours'));

            $user[0]->expire_time = $day;
            $user = $user[0];


            return response(['status' => 'success', 'message' => 'Successfully authenticated', 'data' => $user], 200);
        } else {
            return response(['code' => '1005', 'status' => 'failure', 'message' => 'Invalid credentials'], 401);
        }


    }
}

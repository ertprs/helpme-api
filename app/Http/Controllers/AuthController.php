<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function Login(Request $request) {

        $username = $request->username;
        $password = md5($request->password);

        $validation = DB::select("SELECT id, username, password, token from users WHERE (username = '$username' or email = '$username') and password = '$password'");

        if ($validation) {

            $id = $validation[0]->id;

            $user = DB::select("SELECT id, first_name, permission_id, last_name, username, token from users WHERE id = '$id'");

            $day = date(strtotime('+3 hours'));

            $user[0]->expire_time = $day;
            $user = $user[0];


            return response(['status' => 'success', 'message' => 'Successfully authenticated', 'data' => $user], 200);
        } else {
            return response(['code' => '1005', 'status' => 'failure', 'message' => 'Invalid credentials'], 401);
        }


    }
}

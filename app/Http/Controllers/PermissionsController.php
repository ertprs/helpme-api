<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index() {
        return Permission::all();
    }

    public function new(Request $request) {
        $permission = Permission::create([
            "permission" => $request->permission,
            "status" => $request->status
        ]);
        return $permission;

        $response = [
            "status" => "success",
            "message" => "Permissão cadastrada com sucesso!"
        ];

        return response($response, 201);
    }
}

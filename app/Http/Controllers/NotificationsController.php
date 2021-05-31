<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{

    public function show($user_id) {

        $notifications = DB::select("SELECT n.id, n.user_id, n.message, n.read, to_char(n.created_at, 'DD/MM/YYYY HH24:MI:SS') created_at
                               FROM notifications n
                               INNER JOIN users u ON n.user_id = u.id
                               WHERE n.user_id = $user_id
                               ORDER BY n.id DESC");

        return response(['total' => sizeof($notifications), 'data' => $notifications], 200);
    }

    public function showUnreaded($user_id) {

        $notifications = DB::select("SELECT n.id, n.user_id, n.message, n.read, to_char(n.created_at, 'DD/MM/YYYY HH24:MI:SS') created_at
                               FROM notifications n
                               INNER JOIN users u ON n.user_id = u.id
                               WHERE n.user_id = $user_id AND n.read = false
                               ORDER BY n.id DESC");

        return response(['total' => sizeof($notifications), 'data' => $notifications], 200);
    }

    public function new(Request $request) {

        $users = User::all();

        for ($i=0; $i < sizeof($users); $i++) {

            $user_id = $users[$i]->id;

            try {
                $ticket = Notification::create([
                    'user_id' => $user_id,
                    'client_id' => $request->client_id,
                    'created_by' => $request->user_id,
                    'message' => $request->message,
                    'read' => 0
                ]);

                return response(['status' => 'success', 'message' => 'Notificação criada com sucesso!', 'data' => $ticket], 201);
            } catch(Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }

        }

    }

    public function readAll($user_id) {

        try {

            DB::update("UPDATE notifications SET read = true WHERE user_id = $user_id");

            return response(['status' => 'success', 'message' => 'Notificações lidas com sucesso!'], 201);
        } catch(Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }

    }

    public function read(Request $request, $id) {

        $request = $request->all();
        if(!$notification = Notification::find($id)) {

            return response(["status" => "error", "message" => "Notificação não encontrada!"], 500);

        } else {

            try {

                DB::update("UPDATE notifications SET read = true WHERE id = $id");

                $notification->update($request);

                return response(['status' => 'success', 'message' => 'Notificação atualizada com sucesso!', 'data' => $notification], 201);
            } catch(Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }

        }

    }

    public function unread(Request $request, $id) {

        $request = $request->all();
        if(!$notification = Notification::find($id)) {

            return response(["status" => "error", "message" => "Notificação não encontrada!"], 500);

        } else {

            try {

                DB::update("UPDATE notifications SET read = false WHERE id = $id");

                $notification->update($request);

                return response(['status' => 'success', 'message' => 'Notificação atualizada com sucesso!', 'data' => $notification], 201);
            } catch(Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }

        }

    }

}

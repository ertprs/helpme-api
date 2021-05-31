<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::all();

        for ($i=0; $i < sizeof($users); $i++) {

            $user_id = $users[$i]->id;
            $client_id = $users[$i]->client_id ? $users[$i]->client_id : "NULL";
            $name = $users[$i]->first_name;

            $message = "Olá $name, Seja bem vindo ao sistema help.me!";

            DB::insert("INSERT INTO notifications (user_id, client_id, created_by, message, read) values ($user_id, $client_id, 0, '$message', false) ");
        }

    }
}

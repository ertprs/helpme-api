<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        $header = json_encode($header);
        $header = base64_encode($header);

        $payload = [
            'iss' => 'helpme',
            'name' => "admin",
            'email' => "admin@example.com"
        ];
        $payload = json_encode($payload);
        $payload = base64_encode($payload);

        $signature = hash_hmac('sha256', "$header.$payload", 'devEncLee848625@2021!~', true);
        $signature = base64_encode($signature);

        $jwt_token = "$header.$payload.$signature";

        $api_token = env('JWT_SECRET');
        $user = [
            "permission_id" => 1,
            "first_name" => "Admin",
            "last_name" => "Helpdesk",
            "username" => "admin",
            "email" => "admin@example.com",
            "password" => "admin123",
            "status" => "true",
            "notification" => "true",
            "token" => $jwt_token,
            "api_token" => $api_token
        ];

        DB::table('users')->insert($user);
    }
}

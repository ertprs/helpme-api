<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentesTableSeeder extends Seeder
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
            'iss' => 'cyberdenuncie',
            'name' => "admin",
            'email' => "admin@cyberdenuncie.com.br"
        ];
        $payload = json_encode($payload);
        $payload = base64_encode($payload);

        $signature = hash_hmac('sha256', "$header.$payload", 'devEncLee848625@2021!~', true);
        $signature = base64_encode($signature);

        $jwt_token = "$header.$payload.$signature";

        $api_token = env('JWT_SECRET');
        $agente = [
            "usuario" => "admin",
            "nome_agente" => "Administrador",
            "password" => md5("admin123"),
            "token" => $jwt_token,
            "api_token" => $api_token
        ];

        DB::table('agentes')->insert($agente);
    }
}

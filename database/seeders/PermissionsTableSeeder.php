<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array([
            "permission" => "Administrador",
            "status" => true
        ], [
            "permission" => "Cliente",
            "status" => true
        ]);

        for ($i = 0; $i < sizeOf($permissions); $i++) {
            DB::table('permissions')->insert($permissions[$i]);
        }
    }
}

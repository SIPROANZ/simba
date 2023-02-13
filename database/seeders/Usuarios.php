<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('tipomodificaciones')->delete();
        $json = File::get("database/data/usuarios.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            User::create(array(
            'id' => $obj->id,
            'name' => $obj->name,
            'email' => $obj->email,
            'password' => $obj->password,

            
            ));
        }
    }
}

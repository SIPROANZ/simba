<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Cuentasbancaria;

class Cuentasbancarias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cuentasbancarias')->delete();
        $json = File::get("database/data/cuentasbancarias.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Cuentasbancaria::create(array(
                'id' => $obj->id,
                'banco_id' => $obj->banco_id,
                'institucion_id' => $obj->institucion_id,
                'fechaapertura' => $obj->fechaapertura,
                'montoapertura' => $obj->montoapertura,
                'montosaldo' => $obj->montosaldo,
                'cuenta' => $obj->cuenta,
                'descripcion' => $obj->descripcion
                
                ));
            }
    }
}

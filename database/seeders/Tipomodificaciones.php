<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Tipomodificacione;

class Tipomodificaciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipomodificaciones')->delete();
        $json = File::get("database/data/tipomodificacion.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Tipomodificacione::create(array(
                'id' => $obj->id,
                'nombre' => $obj->nombre
                
                ));
            }
    }
}

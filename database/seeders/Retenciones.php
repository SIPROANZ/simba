<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Retencione;

class Retenciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('retenciones')->delete();
        $json = File::get("database/data/retenciones.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Retencione::create(array(
                'id' => $obj->id,
                'tiporetencion_id' => $obj->tiporetencion_id,
                'descripcion' => $obj->descripcion,
                'porcentaje' => $obj->porcentaje,
                'tipo' => $obj->tipo,
                'base_calculo' => $obj->base_calculo
                
                ));
            }
    }
}

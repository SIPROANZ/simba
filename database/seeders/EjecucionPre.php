<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Ejecucione;

class EjecucionPre extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ejecuciones')->delete();
        $json = File::get("database/data/ejecucion2022.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Ejecucione::create(array(
                'id' => $obj->id,
                'ejercicio_id' => $obj->ejercicio_id,
                'institucion_id' => $obj->institucion_id,
                'unidadadministrativa_id' => $obj->unidadadministrativa_id,
                'meta_id' => $obj->meta_id,
                'clasificadorpresupuestario' => $obj->clasificadorpresupuestario,
                'financiamiento_id' => $obj->financiamiento_id,
                'monto_inicial' => $obj->monto_inicial,
                'monto_aumento' => $obj->monto_aumento,
                'monto_disminuye' => $obj->monto_disminuye,
                'monto_actualizado' => $obj->monto_actualizado,
                'monto_precomprometido' => $obj->monto_precomprometido,
                'monto_comprometido' => $obj->monto_comprometido,
                'monto_causado' => $obj->monto_causado,
                'monto_pagado' => $obj->monto_pagado,
                'monto_por_comprometer' => $obj->monto_por_comprometer,
                'monto_por_causar' => $obj->monto_por_causar,
                'monto_por_pagar' => $obj->monto_por_pagar,
                'poa_id' => $obj->poa_id,
               
                ));
            }
    }
}

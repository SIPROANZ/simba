<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Meta;

class MetaGestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('metas')->delete();
        $json = File::get("database/data/metagestion.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Meta::create(array(
                'id' => $obj->id,
                'poa_id' => $obj->poa_id,
                'cantidad1' => $obj->cantidad_1,
                'cantidad2' => $obj->cantidad_2,
                'cantidad3' => $obj->cantidad_3,
                'cantidad4' => $obj->cantidad_4,
                'meta' => $obj->meta,
                'monto' => $obj->monto,
                'ejercicio_id' => $obj->ejercicio_id,
                'institucion_id' => $obj->institucion_id,
                'unidadadministrativa_id' => $obj->unidadadministrativa_id,
                'tipo' => $obj->tipo,
                'enero' => $obj->enero,
                'febrero' => $obj->febrero,
                'marzo' => $obj->marzo,
                'abril' => $obj->abril,
                'mayo' => $obj->mayo,
                'junio' => $obj->junio,
                'julio' => $obj->julio,
                'agosto' => $obj->agosto,
                'septiembre' => $obj->septiembre,
                'octubre' => $obj->octubre,
                'noviembre' => $obj->noviembre,
                'diciembre' => $obj->diciembre,
                'unidadmedida' => $obj->unidadmedida,
                'unidadadministrativasolicitante' => $obj->unidadadministrativasolicitante,
                'impacto' => $obj->impacto,

                ));
            }

            
    }
}

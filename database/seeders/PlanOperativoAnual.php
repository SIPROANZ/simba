<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Poa;

class PlanOperativoAnual extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('poas')->delete();
        $json = File::get("database/data/planoperativo.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Poa::create(array(
                'id' => $obj->id,
                'ejercicio_id' => $obj->ejercicio_id,
                'institucion_id' => $obj->institucion_id,
                'historico_id' => $obj->historico_id,
                'nacional_id' => $obj->nacional_id ,
                'estrategico_id' => $obj->estrategico_id,
                'general_id' => $obj->general_id,
                'municipal_id' => $obj->municipal_id,
                'pei_id' => $obj->pei_id,
                'unidadadministrativa_id' => $obj->unidadadministrativa_id,
                'proyecto' => $obj->proyecto,
                'objetivoproyecto' => $obj->objetivoproyecto,
                'montoproyecto' => $obj->montoproyecto,
                'responsable' => $obj->responsable,
                'tipo' => $obj->tipo,
                'sncfestrategico' => $obj->sncfestrategico,
                'sncfespecifico' => $obj->sncfespecifico,
                'psocial' => $obj->psocial,
                'codigo' => $obj->codigo,
                'tipoproyecto' => $obj->tipoproyecto,
                'central' => $obj->central,
                'descripcion' => $obj->descripcion,

                ));
            }
    }
}

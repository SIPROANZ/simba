<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Unidadadministrativa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class IndiceCategoria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidadadministrativas')->delete();
        $json = File::get("database/data/indicecategoria.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Unidadadministrativa::create(array(
                'ejercicio_id' => $obj->ejercicio_id,
                'sector' => $obj->sector,
                'programa' => $obj->programa,
                'subprograma' => $obj->subprograma,
                'proyecto' => $obj->proyecto,
                'actividad' => $obj->actividad,
                'denominacion' => $obj->denominacion,
                'unidadejecutora' => $obj->unidadejecutora,
                'institucion_id' => $obj->institucion_id,
                'nivel' => $obj->nivel,
                'email' => $obj->email,
                'telefono' => $obj->telefono,
                'descripcion' => $obj->descripcion,
                'inversion'=>$obj->inversion,
                'nivelejecutor' => $obj->nivelejecutor,

                ));
            }
    }
}

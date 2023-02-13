<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Beneficiario;

class Beneficiarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('beneficiarios')->delete();
        $json = File::get("database/data/beneficiarios.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Beneficiario::create(array(
                'id' => $obj->id,
                'caracterbeneficiario' => $obj->caracterbeneficiario,
                'documento' => $obj->documento,
                'rif' => $obj->rif,
                'tiporesidencia' => $obj->tiporecidencia,
                'tipobeneficiario' => $obj->tipobeneficiario,
                'tipocontribuyente' => $obj->tipocontribuyente,
                'nombre' => $obj->nombre,
                'direccion' => $obj->direccion,
                'telefono' => $obj->telefono,
                'correo' => $obj->correo,
                'banco' => $obj->banco,
                'numerocuenta' => $obj->banco,
                'documentorepresentante' => $obj->documentorepresentante,
                'nombrerepresentante' => $obj->nombrerepresentante,
                'telefonorepresentante' => $obj->telefonorepresentante,
                'correorepresentante' => $obj->correorepresentante,
                'bancorepresentante' => $obj->bancorepresentante,
                'numerocuentarepresentante' => $obj->nmerocuentarepresentante,

                ));
            }
    }
}

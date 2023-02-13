<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Tipodecompromiso;

class Tipodecompromisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipodecompromisos')->delete();
        $json = File::get("database/data/tipocompromisos.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Tipodecompromiso::create(array(
                'id' => $obj->id,
                'nombre' => $obj->nombre
                
                ));
            }
    }
}

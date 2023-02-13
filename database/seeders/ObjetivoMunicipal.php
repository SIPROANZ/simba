<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Objetivomunicipale;

class ObjetivoMunicipal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('objetivomunicipales')->delete();
        $json = File::get("database/data/objetivomunicipal.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Objetivomunicipale::create(array(
                'id' => $obj->id,
                'objetivomunicipal' => $obj->objetivomunicipal,
                'objetivo' => $obj->objetivo,
                ));
            }
    }
    
}

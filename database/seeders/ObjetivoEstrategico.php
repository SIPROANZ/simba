<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Objetivosestrategico;

class ObjetivoEstrategico extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = File::get("database/data/objetivoestrategico.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Objetivosestrategico::create(array(
                'id' => $obj->id,
                'objetivoestrategico' => $obj->objetivoestrategico,
                'objetivo' => $obj->objetivo,
                'nacional_id' => $obj->nacional_id,
                ));
            }
    }
}

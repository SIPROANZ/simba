<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Objetivogenerale;

class ObjetivoGeneral extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = File::get("database/data/objetivogeneral.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Objetivogenerale::create(array(
                'id' => $obj->id,
                'objetivogeneral' => $obj->objetivogeneral,
                'objetivo' => $obj->objetivo,
                'estrategico_id' => $obj->estrategico_id,
                ));
            }
    }
}

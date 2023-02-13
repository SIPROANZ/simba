<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Objetivonacionale;

class ObjetivoNacional extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = File::get("database/data/objetivonacional.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Objetivonacionale::create(array(
                'objetivonacional' => $obj->objetivonacional,
                'objetivo' => $obj->objetivo,
                'historico_id' => $obj->historico_id,
                ));
            }
    }
}

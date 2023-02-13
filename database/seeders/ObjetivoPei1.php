<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Objetivopei;

class ObjetivoPei1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = File::get("database/data/objetivopei.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Objetivopei::create(array(
                'id' => $obj->id,
                'objetivopei' => $obj->id,
                'objetivo' => $obj->objetivo,
                'municipal_id' => $obj->municipal_id,
                ));
            }
    }
}

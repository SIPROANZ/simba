<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Objetivoshistorico;

class ObjetivosHistoricos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('cities')->delete();
    $json = File::get("database/data/objetivohistorico.json");
    $data = json_decode($json);
    foreach ($data as $obj) {
        Objetivoshistorico::create(array(
        'id' => $obj->id,
        'objetivo' => $obj->objetivo,
    ));
    }
    }
}

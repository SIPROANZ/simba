<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Banco;

class Bancos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bancos')->delete();
        $json = File::get("database/data/bancos.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Banco::create(array(
                'id' => $obj->id,
                'denominacion' => $obj->denominacion
                
                ));
            }
    }
}

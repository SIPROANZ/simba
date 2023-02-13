<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallesprecompromisos', function (Blueprint $table) {
            $table->id();
            $table->double('montocompromiso', 25, 2);
            
            $table->bigInteger('precompromiso_id')->unsigned();
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->bigInteger('ejecucion_id')->unsigned();

            $table->foreign('precompromiso_id')->references('id')->on('precompromisos')->onDelete('cascade');
            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');
            $table->foreign('ejecucion_id')->references('id')->on('ejecuciones')->onDelete('cascade');
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detallesprecompromisos');
    }
};

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
        Schema::create('ejecuciondetalles', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ejecucion_id')->unsigned();
            $table->string('periodofiscal', 10);
            $table->bigInteger('institucion_id')->unsigned();
            $table->string('sector', 4);
            $table->string('programa', 4);
            $table->string('subprograma', 4);
            $table->string('proyecto', 4);
            $table->string('actividad', 4);
            $table->string('cuenta', 20);
            $table->bigInteger('financiamiento_id')->unsigned();
            $table->double('monto_inicial', 25, 2);
            $table->double('monto_aumento', 25, 2);
            $table->double('monto_disminucion', 25, 2);
            $table->double('monto_compromisos', 25, 2);
            $table->double('monto_causados', 25, 2);
            $table->double('monto_pagados', 25, 2);
            $table->string('logins', 20);
            $table->string('unidadejecutora', 200);



            $table->foreign('ejecucion_id')->references('id')->on('ejecuciones')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
            $table->foreign('financiamiento_id')->references('id')->on('financiamientos')->onDelete('cascade');
            

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
        Schema::dropIfExists('ejecuciondetalles');
    }
};

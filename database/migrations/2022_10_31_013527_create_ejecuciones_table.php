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
        Schema::create('ejecuciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ejercicio_id')->unsigned();
            $table->bigInteger('institucion_id')->unsigned();
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->bigInteger('meta_id')->unsigned();
            $table->string('clasificadorpresupuestario', 15);
            $table->bigInteger('financiamiento_id')->unsigned();
            $table->double('monto_inicial', 25, 2);
            $table->double('monto_aumento', 25, 2);
            $table->double('monto_disminuye', 25, 2);
            $table->double('monto_actualizado', 25, 2);
            $table->double('monto_precomprometido', 25, 2);
            $table->double('monto_comprometido', 25, 2);
            $table->double('monto_causado', 25, 2);
            $table->double('monto_pagado', 25, 2);
            $table->double('monto_por_comprometer', 25, 2);
            $table->double('monto_por_causar', 25, 2);
            $table->double('monto_por_pagar', 25, 2);
            $table->bigInteger('poa_id')->unsigned();

            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');
            $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
            $table->foreign('financiamiento_id')->references('id')->on('financiamientos')->onDelete('cascade');
            $table->foreign('poa_id')->references('id')->on('poas')->onDelete('cascade');

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
        Schema::dropIfExists('ejecuciones');
    }
};

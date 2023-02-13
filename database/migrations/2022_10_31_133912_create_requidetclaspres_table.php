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
        Schema::create('requidetclaspres', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('requisicion_id')->unsigned();
            $table->bigInteger('poa_id')->unsigned();
            $table->bigInteger('meta_id')->unsigned();
            $table->bigInteger('financiamiento_id')->unsigned();

            $table->double('disponible', 25, 2);
            $table->string('claspres', 15);

            $table->bigInteger('ejecucion_id')->unsigned();
         

            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onDelete('cascade');
            $table->foreign('poa_id')->references('id')->on('poas')->onDelete('cascade');
            $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
            $table->foreign('financiamiento_id')->references('id')->on('financiamientos')->onDelete('cascade');
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
        Schema::dropIfExists('requidetclaspres');
    }
};

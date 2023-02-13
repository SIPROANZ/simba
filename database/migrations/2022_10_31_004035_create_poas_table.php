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
        Schema::create('poas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ejercicio_id')->unsigned();
            $table->bigInteger('institucion_id')->unsigned();
            $table->bigInteger('historico_id')->unsigned();
            $table->bigInteger('nacional_id')->unsigned();
            $table->bigInteger('estrategico_id')->unsigned();
            $table->bigInteger('general_id')->unsigned();
            $table->bigInteger('municipal_id')->unsigned();
            $table->bigInteger('pei_id')->unsigned();
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            
            $table->text('proyecto');
            $table->text('objetivoproyecto');
            $table->double('montoproyecto', 25, 2);
            $table->integer('responsable')->unsigned();
            $table->string('tipo', 10);
            $table->integer('sncfestrategico')->unsigned();
            $table->integer('sncfespecifico')->unsigned();
            $table->string('psocial', 10);
            $table->string('codigo', 20);
            $table->string('tipoproyecto', 10);
            $table->string('central', 10);
            $table->text('descripcion');


            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
             $table->foreign('historico_id')->references('id')->on('objetivoshistoricos')->onDelete('cascade');
            $table->foreign('nacional_id')->references('id')->on('objetivogenerales')->onDelete('cascade');
            $table->foreign('estrategico_id')->references('id')->on('objetivosestrategicos')->onDelete('cascade');
            $table->foreign('general_id')->references('id')->on('objetivogenerales')->onDelete('cascade');
            $table->foreign('municipal_id')->references('id')->on('objetivomunicipales')->onDelete('cascade');
            $table->foreign('pei_id')->references('id')->on('objetivopeis')->onDelete('cascade');
            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');

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
        Schema::dropIfExists('poas');
    }
};

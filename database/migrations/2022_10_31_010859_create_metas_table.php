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
        Schema::create('metas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('poa_id')->unsigned();
            $table->integer('cantidad1')->unsigned();
            $table->integer('cantidad2')->unsigned();
            $table->integer('cantidad3')->unsigned();
            $table->integer('cantidad4')->unsigned();
            $table->text('meta');
            $table->double('monto', 25, 8);
            $table->bigInteger('ejercicio_id')->unsigned();
            $table->bigInteger('institucion_id')->unsigned();
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->string('tipo', 10);

            $table->integer('enero')->unsigned();
            $table->integer('febrero')->unsigned();
            $table->integer('marzo')->unsigned();
            $table->integer('abril')->unsigned();
            $table->integer('mayo')->unsigned();
            $table->integer('junio')->unsigned();
            $table->integer('julio')->unsigned();
            $table->integer('agosto')->unsigned();
            $table->integer('septiembre')->unsigned();
            $table->integer('octubre')->unsigned();
            $table->integer('noviembre')->unsigned();
            $table->integer('diciembre')->unsigned();

            $table->string('unidadmedida', 50);
            $table->integer('unidadadministrativasolicitante')->unsigned();
            $table->integer('impacto')->unsigned();


            $table->foreign('poa_id')->references('id')->on('poas')->onDelete('cascade');
            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
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
        Schema::dropIfExists('metas');
    }
};

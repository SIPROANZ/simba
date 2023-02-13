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
        Schema::create('requisiciones', function (Blueprint $table) {
            $table->id();

            $table->text('concepto');
            $table->text('uso');
            $table->bigInteger('ejercicio_id')->unsigned();
            $table->bigInteger('institucion_id')->unsigned();
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->integer('correlativo')->unsigned();
            $table->bigInteger('tiposgp_id')->unsigned();
            $table->string('estatus', 10);

            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');
            $table->foreign('tiposgp_id')->references('id')->on('tipossgps')->onDelete('cascade');

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
        Schema::dropIfExists('requisiciones');
    }
};

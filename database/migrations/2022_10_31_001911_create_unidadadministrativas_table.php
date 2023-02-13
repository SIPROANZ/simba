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
        Schema::create('unidadadministrativas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ejercicio_id')->unsigned();
            $table->string('sector', 4);
            $table->string('programa', 4);
            $table->string('subprograma', 4);
            $table->string('proyecto', 4);
            $table->string('actividad', 4);
            $table->string('denominacion', 200);
            $table->string('unidadejecutora', 200);
            $table->bigInteger('institucion_id')->unsigned();
            $table->string('nivel', 4);
            $table->string('email', 50);
            $table->string('telefono', 50);
            $table->text('descripcion');
            $table->string('inversion', 10);
            $table->string('nivelejecutor', 10);


            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');

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
        Schema::dropIfExists('unidadadministrativas');
    }
};

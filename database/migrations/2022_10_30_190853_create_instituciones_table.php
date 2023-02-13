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
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id();

            $table->string('rif', 20);
            $table->string('institucion', 200);
            $table->text('direccion');
            $table->string('telefono', 100);
            $table->string('email', 100);
            $table->text('baselegal');
            $table->string('web', 100);
            $table->string('codigopostal', 10);
            $table->string('organigrama', 100);
            $table->string('logoinstitucion', 100);
            $table->text('vision');
            $table->text('mision');
            $table->string('razonsocial', 100);

            $table->bigInteger('municipio_id')->unsigned();
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('cascade');


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
        Schema::dropIfExists('instituciones');
    }
};

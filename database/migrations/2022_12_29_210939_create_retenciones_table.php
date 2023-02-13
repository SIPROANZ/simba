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
        Schema::create('retenciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tiporetencion_id')->unsigned();
            $table->string('descripcion', 255);
            $table->double('porcentaje', 6, 2);
            $table->string('tipo', 1);
            $table->foreign('tiporetencion_id')->references('id')->on('tiporetenciones')->onDelete('cascade');
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
        Schema::dropIfExists('retenciones');
    }
};

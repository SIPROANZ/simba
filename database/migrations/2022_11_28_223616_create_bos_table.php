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
        Schema::create('bos', function (Blueprint $table) {
            $table->id();

            $table->text('descripcion');

            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('unidadmedida_id')->unsigned();
            $table->bigInteger('tipobos_id')->unsigned();

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('unidadmedida_id')->references('id')->on('unidadmedidas')->onDelete('cascade');
            $table->foreign('tipobos_id')->references('id')->on('tipobos')->onDelete('cascade');

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
        Schema::dropIfExists('bos');
    }
};

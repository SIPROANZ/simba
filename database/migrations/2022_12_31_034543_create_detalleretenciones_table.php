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
        Schema::create('detalleretenciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('retencion_id')->unsigned();
            $table->bigInteger('ordenpago_id')->unsigned();
            $table->double('montoneto', 25, 2);
            $table->double('montoIVA', 25, 2);
            $table->foreign('retencion_id')->references('id')->on('retenciones')->onDelete('cascade');
            $table->foreign('ordenpago_id')->references('id')->on('ordenpagos')->onDelete('cascade');
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
        Schema::dropIfExists('detalleretenciones');
    }
};

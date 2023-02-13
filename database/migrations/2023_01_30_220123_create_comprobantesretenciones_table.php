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
        Schema::create('comprobantesretenciones', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('tiporetencion_id')->unsigned();

            $table->bigInteger('ordenpago_id')->unsigned();

            $table->double('montoretencion', 25, 2);

            $table->foreign('tiporetencion_id')->references('id')->on('tiporetenciones')->onDelete('cascade');
            
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
        Schema::dropIfExists('comprobantesretenciones');
    }
};

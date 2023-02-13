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
        Schema::create('analisis', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->bigInteger('requisicion_id')->unsigned();
            $table->bigInteger('criterio_id')->unsigned();

            $table->bigInteger('numeracion')->unsigned();
            $table->string('observacion', 400);

            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');
            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onDelete('cascade');
            $table->foreign('criterio_id')->references('id')->on('criterios')->onDelete('cascade');
            

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
        Schema::dropIfExists('analisis');
    }
};

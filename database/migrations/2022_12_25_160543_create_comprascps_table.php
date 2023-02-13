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
        Schema::create('comprascps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('compra_id')->unsigned();
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->bigInteger('ejecucion_id')->unsigned();

            $table->double('monto', 25, 2);
            $table->double('disponible', 25, 2);

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');
            $table->foreign('ejecucion_id')->references('id')->on('ejecuciones')->onDelete('cascade');
           


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
        Schema::dropIfExists('comprascps');
    }
};

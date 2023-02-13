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
        Schema::create('modificaciones', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('numero')->unsigned();
            $table->bigInteger('tipomodificacion_id')->unsigned();
            $table->text('descripcion');
            $table->string('status', 10);
            $table->date('fechaanulacion');
            $table->double('montocredita', 25, 2);
            $table->double('montodebita', 25, 2);
            $table->string('ncredito', 40);

            //llaves foraneas
            $table->foreign('tipomodificacion_id')->references('id')->on('tipomodificaciones')->onDelete('cascade');
            
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
        Schema::dropIfExists('modificaciones');
    }
};

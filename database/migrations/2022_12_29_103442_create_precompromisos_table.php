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
        Schema::create('precompromisos', function (Blueprint $table) {
            $table->id();

            $table->string('documento', 40);
            $table->double('montototal', 25, 2);
            $table->text('concepto');

            $table->date('fechaanulacion');
            //llaves foraneas
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->bigInteger('tipocompromiso_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();

            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');
            $table->foreign('tipocompromiso_id')->references('id')->on('tipodecompromisos')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            

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
        Schema::dropIfExists('precompromisos');
    }
};

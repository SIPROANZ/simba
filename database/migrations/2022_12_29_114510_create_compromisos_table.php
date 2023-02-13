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
        Schema::create('compromisos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('unidadadministrativa_id')->unsigned();
            $table->bigInteger('tipocompromiso_id')->unsigned();
            $table->bigInteger('ncompromiso')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();

            $table->double('montocompromiso', 25, 2);

            $table->string('status', 10);
            $table->string('documento', 40);

            $table->date('fechaanulacion');

            $table->bigInteger('precompromiso_id')->unsigned()->nullable();
            $table->bigInteger('compra_id')->unsigned()->nullable();
            $table->bigInteger('ayuda_id')->unsigned()->nullable();

            $table->foreign('unidadadministrativa_id')->references('id')->on('unidadadministrativas')->onDelete('cascade');
            $table->foreign('tipocompromiso_id')->references('id')->on('tipodecompromisos')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            
            $table->foreign('precompromiso_id')->references('id')->on('precompromisos')->onDelete('cascade');
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('ayuda_id')->references('id')->on('ayudassociales')->onDelete('cascade');
           
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
        Schema::dropIfExists('compromisos');
    }
};

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
        Schema::create('movimientosbancarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ejercicio_id')->unsigned();
            $table->bigInteger('institucion_id')->unsigned();
            $table->bigInteger('cuentasbancaria_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();
            $table->bigInteger('tipomovimiento_id')->unsigned();
            $table->string('referencia', 10);
            $table->string('descripcion', 10);
            $table->date('fecha');
            $table->double('monto', 25, 2);
            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
            $table->foreign('cuentasbancaria_id')->references('id')->on('cuentasbancarias')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            $table->foreign('tipomovimiento_id')->references('id')->on('tipomovimientos')->onDelete('cascade');
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
        Schema::dropIfExists('movimientosbancarios');
    }
};

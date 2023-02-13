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
        Schema::create('notasdedebitos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ejercicio_id')->unsigned();
            $table->bigInteger('institucion_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();
            $table->bigInteger('banco_id')->unsigned();
            $table->bigInteger('cuentabancaria_id')->unsigned();
            $table->date('fecha')->nullable();
            $table->string('referencia', 100);
            $table->text('descripcion');
            $table->double('monto', 25, 2);

            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->foreign('cuentabancaria_id')->references('id')->on('cuentasbancarias')->onDelete('cascade');
            
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
        Schema::dropIfExists('notasdedebitos');
    }
};

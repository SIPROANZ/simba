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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();

            $table->string('caracterbeneficiario', 4);
            $table->string('documento', 20);
            $table->string('rif', 20);
            $table->string('tiporesidencia', 30);
            $table->string('tipobeneficiario', 20);
            $table->string('tipocontribuyente', 20);
            $table->string('nombre', 100);
            $table->string('direccion', 450);
            $table->string('telefono', 50);
            $table->string('correo', 100);
            $table->string('banco', 50);
            $table->string('numerocuenta', 30);
            //Area para el representante legal
            $table->string('documentorepresentante', 20);
            $table->string('nombrerepresentante', 100);
            $table->string('telefonorepresentante', 50);
            $table->string('correorepresentante', 100);
            $table->string('bancorepresentante', 50);
            $table->string('numerocuentarepresentante', 30);
            
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
        Schema::dropIfExists('proveedores');
    }
};

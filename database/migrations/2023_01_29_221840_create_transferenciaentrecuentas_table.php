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
        Schema::create('transferenciaentrecuentas', function (Blueprint $table) {
            $table->id();

            $table->double('monto', 25, 2);
            $table->date('fecha');
            $table->string('referencia', 100);
            $table->text('descripcion');

            $table->bigInteger('bancoorigen_id')->unsigned();
            $table->bigInteger('cuentaorigen_id')->unsigned();
            $table->bigInteger('bancodestino_id')->unsigned();
            $table->bigInteger('cuentadestino_id')->unsigned();

            $table->foreign('bancoorigen_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->foreign('cuentaorigen_id')->references('id')->on('cuentasbancarias')->onDelete('cascade');
            $table->foreign('bancodestino_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->foreign('cuentadestino_id')->references('id')->on('cuentasbancarias')->onDelete('cascade');

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
        Schema::dropIfExists('transferenciaentrecuentas');
    }
};

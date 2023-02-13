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
        Schema::create('detallesanalisis', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('proveedor_id')->unsigned();
            $table->bigInteger('analisis_id')->unsigned();
            $table->bigInteger('bos_id')->unsigned();

            $table->double('cantidad', 25, 2);
            $table->double('precio', 25, 2);
            $table->double('subtotal', 25, 2);
            $table->double('iva', 25, 2);
            $table->double('total', 25, 2);

            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
            $table->foreign('analisis_id')->references('id')->on('analisis')->onDelete('cascade');
            $table->foreign('bos_id')->references('id')->on('bos')->onDelete('cascade');
            
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
        Schema::dropIfExists('detallesanalisis');
    }
};

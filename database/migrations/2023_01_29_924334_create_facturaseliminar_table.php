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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('ordenpago_id')->unsigned();
            $table->string('numero_factura', 50);
            $table->string('numero_control', 50);
            $table->date('fecha')->nullable();
            $table->double('montobase', 25, 2);
            $table->double('montoiva', 25, 2);
            $table->double('montototal', 25, 2);

            //La relacion con la orden de pago
            $table->foreign('ordenpago_id')->references('id')->on('ordenpagos')->onDelete('cascade');


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
        Schema::dropIfExists('facturas');
    }
};

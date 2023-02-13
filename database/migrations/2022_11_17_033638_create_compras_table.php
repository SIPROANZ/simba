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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('analisis_id')->unsigned();
            $table->bigInteger('numordencompra')->unsigned();
            $table->string('status', 15);
            $table->date('fechaanulacion');
            $table->double('montobase', 25, 2);
            $table->double('montoiva', 25, 2);
            $table->double('montototal', 25, 2);

            $table->foreign('analisis_id')->references('id')->on('analisis')->onDelete('cascade');
            
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
        Schema::dropIfExists('compras');
    }
};

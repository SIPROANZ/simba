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
        Schema::create('ajustescompromisos', function (Blueprint $table) {
            $table->id();
            
            $table->string('tipo', 15);
            $table->bigInteger('compromiso_id')->unsigned();
            $table->string('documento', 40);
            $table->text('concepto');
            $table->double('montoajuste', 25, 2);

            $table->foreign('compromiso_id')->references('id')->on('compromisos')->onDelete('cascade');
           
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
        Schema::dropIfExists('ajustescompromisos');
    }
};

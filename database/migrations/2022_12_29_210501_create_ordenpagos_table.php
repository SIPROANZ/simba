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
        Schema::create('ordenpagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nordenpago')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();
            $table->double('montobase', 25, 2);
            $table->double('montoretencion', 25, 2)->nullable();
            $table->double('montoneto', 25, 2);
            $table->date('fechaanulacion')->nullable();
            $table->string('status', 10);
            $table->bigInteger('tipoorden')->unsigned();
            $table->double('montoiva', 25, 2);
            $table->double('montoexento', 25, 2)->nullable();
            $table->bigInteger('compromiso_id')->unsigned();
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
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
        Schema::dropIfExists('ordenpagos');
    }
};

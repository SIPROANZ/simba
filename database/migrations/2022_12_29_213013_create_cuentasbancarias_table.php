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
        Schema::create('cuentasbancarias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('banco_id')->unsigned();
            $table->bigInteger('institucion_id')->unsigned();
            $table->date('fechaapertura');
            $table->double('montoapertura', 25, 2);
            $table->double('montosaldo', 25, 2);
            $table->string('cuenta', 30);
            $table->string('descripcion', 50);
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
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
        Schema::dropIfExists('cuentasbancarias');
    }
};

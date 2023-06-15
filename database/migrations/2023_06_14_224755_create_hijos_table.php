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
        Schema::create('hijos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 150);
            $table->string('cedula', 150);
            $table->string('genero', 10);
            $table->string('anexocedula', 180);
            $table->string('anexopartida', 180);
            $table->string('cedularepresentante', 150);
            $table->text('observacion');

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
        Schema::dropIfExists('hijos');
    }
};

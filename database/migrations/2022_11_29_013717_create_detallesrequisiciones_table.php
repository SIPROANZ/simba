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
        Schema::create('detallesrequisiciones', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('requisicion_id')->unsigned();
            $table->bigInteger('bos_id')->unsigned();
            $table->double('cantidad', 25, 2);


            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onDelete('cascade');

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
        Schema::dropIfExists('detallesrequisiciones');
    }
};

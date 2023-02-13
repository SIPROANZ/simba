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
        Schema::create('objetivopeis', function (Blueprint $table) {
            $table->id();
            $table->integer('objetivopei')->unsigned();
            $table->text('objetivo');

            $table->bigInteger('municipal_id')->unsigned();

            $table->foreign('municipal_id')->references('id')->on('objetivomunicipales')->onDelete('cascade');
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
        Schema::dropIfExists('objetivopeis');
    }
};

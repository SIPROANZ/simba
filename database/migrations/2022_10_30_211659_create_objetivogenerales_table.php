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
        Schema::create('objetivogenerales', function (Blueprint $table) {
            $table->id();

            $table->integer('objetivogeneral')->unsigned();
            $table->text('objetivo');

            $table->bigInteger('estrategico_id')->unsigned();

            $table->foreign('estrategico_id')->references('id')->on('objetivosestrategicos')->onDelete('cascade');


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
        Schema::dropIfExists('objetivogenerales');
    }
};

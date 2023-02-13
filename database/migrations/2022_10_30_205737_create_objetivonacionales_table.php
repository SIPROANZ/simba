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
        Schema::create('objetivonacionales', function (Blueprint $table) {
            $table->id();
            
            $table->integer('objetivonacional')->unsigned();
            $table->text('objetivo');

            $table->bigInteger('historico_id')->unsigned();

            $table->foreign('historico_id')->references('id')->on('objetivoshistoricos')->onDelete('cascade');

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
        Schema::dropIfExists('objetivonacionales');
    }
};

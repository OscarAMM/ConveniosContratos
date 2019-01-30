<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenio', function (Blueprint $table) {
            $table->increments('clavecontrato');
            $table->string('nombre');
            $table->string('recepcion');
            $table->string('objetivo');
            $table->string('vigencia');
            $table->string('tipo');
            $table->string('ambito');
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
        Schema::dropIfExists('convenio');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('reception');
            $table->string('objective');
            $table->date('contractValidity');
            $table->string('scope');
         // $table->integer('file_id')->unsigned()->nullable();
          //$table->foreign('file_id')->references('id')->on('files');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}

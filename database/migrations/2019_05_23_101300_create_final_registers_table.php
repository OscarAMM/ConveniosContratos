<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('reception');
            $table->text('objective');
            $table->string('legalInstrument');
            $table->integer('registerNumber')->nullable();
            $table->date('signature')->nullable();
            $table->date('validity')->nullable();
            $table->date('session')->nullable();
            $table->text('observation')->nullable();
            $table->string('scope');
            $table->boolean('hide')->nullable();
            $table->string('instrumentType');
            $table->date('end_date');
            $table->string('status');
            $table->integer('people_id')->unsigned();

            $table->timestamps();
            $table->foreign('people_id')->references('id')->on('people')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('final_registers');
    }
}

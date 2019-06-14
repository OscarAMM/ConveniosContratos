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
            $table->text('name');
            //$table->date('reception');
            $table->text('objective')->nullable();
            $table->string('legalInstrument')->nullable();
            $table->string('registerNumber')->nullable();
            $table->date('signature')->nullable();
            $table->date('session')->nullable();
            $table->text('observation')->nullable();
            $table->string('scope')->nullable();
            $table->boolean('hide')->nullable();
            $table->string('instrumentType')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->nullable();
            $table->String('countries')->nullable();
            $table->string('person')->nullable();


            //$table->integer('people_id')->unsigned();

            $table->timestamps();
            //$table->foreign('people_id')->references('id')->on('people')->onUpdate('cascade')->onDelete('cascade');


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

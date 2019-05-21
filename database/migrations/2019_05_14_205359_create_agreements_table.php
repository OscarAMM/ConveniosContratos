<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('reception');
            $table->text('objective');
            $table->string('legalInstrument');
            $table->integer('registerNumber');
            $table->string('scope');
            $table->boolean('hide')->nullable();
            $table->date('start_date');
            $table->string('instrumentType');
            $table->date('end_date');
            $table->string('status');
            $table->integer('liable_user')->unsigned();
            $table->integer('people_id')->unsigned();

            $table->timestamps();
            $table->foreign('liable_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('agreements');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionDependenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependence_institute', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institute_id')->unsigned();
            $table->integer('dependence_id')->unsigned();
            $table->foreign('institute_id')->references('id')->on('institutes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('dependence_id')->references('id')->on('dependences')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('dependence_institute');
    }
}

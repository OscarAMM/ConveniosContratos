<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileAgreementFinalRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_agreement_final_register', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_agreement_id')->unsigned();
            $table->integer('final_register_id')->unsigned();
            $table->foreign('file_agreement_id')->references('id')->on('file_agreements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('final_register_id')->references('id')->on('final_registers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('file_agreement_final_register');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementFileAgreementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_file_agreement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_agreement_id')->unsigned();
            $table->integer('agreement_id')->unsigned();
            $table->foreign('file_agreement_id')->references('id')->on('file_agreements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('agreement_id')->references('id')->on('agreements')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('agreement_file_agreement');
    }
}

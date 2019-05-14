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
            $table->date('agreementValidity');
            $table->string('scope');
            $table->boolean('hide');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->integer('liable_user')->unsigned();
            $table->integer('dependence_id')->unsigned();

            $table->foreign('dependence_id')->references('id')->on('dependences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liable_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('agreements');
    }
}

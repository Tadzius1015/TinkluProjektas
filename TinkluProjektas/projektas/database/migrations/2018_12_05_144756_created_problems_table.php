<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('devicename');
            $table->string('description');
            $table->string('status');
            $table->string('ip');
            $table->dateTime('registrationtime');
            $table->dateTime('takingtime');
            $table->dateTime('fixingtime');
            $table->integer('operatorid')->unsigned();
            $table->foreign('operatorid')->references('id')->on('users');
            $table->integer('technicid')->unsigned();
            $table->foreign('technicid')->references('id')->on('users');
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
        Schema::drop('problems');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedDevicesreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('problem');
            $table->string('description');
            $table->dateTime('registrationtime');
            $table->dateTime('takingtime');
            $table->dateTime('fixingtime');
            $table->string('operatorname');
            $table->string('operatorsurname');
            $table->string('technicname');
            $table->string('technicsurname');
            $table->string('technicdescription')->nullable();
            $table->string('reportdescription')->nullable();
            $table->integer('notworkingtime')->nullable();
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
        Schema::drop('devicesreport');
    }
}

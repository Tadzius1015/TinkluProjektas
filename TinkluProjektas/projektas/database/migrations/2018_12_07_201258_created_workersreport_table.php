<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedWorkersreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workername');
            $table->string('workersurname');
            $table->double('avgresponsetime');
            $table->double('avgfixingtime');
            $table->dateTime('intervalbegin');
            $table->dateTime('intervalend');
            $table->integer('repaireddevicescount');
            $table->integer('takingdevicescount');
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
        Schema::drop('workersreport');
    }
}

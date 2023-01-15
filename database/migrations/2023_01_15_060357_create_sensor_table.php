<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->bigIncrements('id_sensors');
            $table->bigInteger('id_cages')->unsigned();
            $table->bigInteger('id_devices')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_cages')->references('id_cages')->on('cages');
            $table->foreign('id_devices')->references('id_devices')->on('devices');
            $table->unique(array('id_devices'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor');
    }
};

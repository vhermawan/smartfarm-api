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
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id_devices');
            $table->bigInteger('id_ref_sensors')->unsigned();
            $table->string('key');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_ref_sensors')->references('id_ref_sensors')->on('ref_sensors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device');
    }
};

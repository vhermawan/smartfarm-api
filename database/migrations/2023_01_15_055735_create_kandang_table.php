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
        Schema::create('kandang', function (Blueprint $table) {
            $table->bigIncrements('id_kandang');
            $table->bigInteger('id_users')->unsigned();
            $table->text('alamat');
            $table->text('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_users')->references('id_users')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kandang');
    }
};

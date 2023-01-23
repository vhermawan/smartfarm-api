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
        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('id_role');
            $table->string('nama_role');
            $table->timestamps();
        });
        DB::table('role')->insert([
            [
                'id_role'       => '1',
                'nama_role'      => 'Admin',
            ],
            [
                'id_role'       => '2',
                'nama_role'      => 'Pemilik',
            ],
            [
                'id_role'       => '3',
                'nama_role'      => 'Peternak',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
};

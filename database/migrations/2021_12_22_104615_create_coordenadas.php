<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordenadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenadas', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_cita',32)->default('');
            $table->string('id_referencia',32);
            $table->float('lat',30,15);
            $table->float('lon',30,15);
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
        Schema::dropIfExists('coordenadas');
    }
}

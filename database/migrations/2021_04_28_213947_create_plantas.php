<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantas', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('planta',150);
            $table->string('siglas',20)->default('');
            $table->string('direccion',500);
            $table->string('codigo',500);
            $table->string('plantaauto',100);
            $table->boolean('activa')->default(true);
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
        Schema::dropIfExists('plantas');
    }
}

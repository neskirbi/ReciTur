<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->string("id",32)->unique();
            $table->string("id_empresatransporte",32);
            
            $table->string("vehiculo",100);
            $table->string("marca",100);
            $table->string("modelo",100);
            $table->string("matricula",100);
            $table->string("combustible",50);
            
            $table->boolean("confirmacion")->default(0);
            $table->string("detalle",100);
            
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
        Schema::dropIfExists('vehiculos');
    }
}

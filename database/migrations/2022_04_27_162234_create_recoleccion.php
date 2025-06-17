<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecoleccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recoleccion', function (Blueprint $table) {
            $table->string("id",32)->unique();            
            $table->string('id_recolector',32);                       
            $table->string('id_negocio',32);
            $table->string('negocio',500);            
            $table->datetime('fechavisita');
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
        Schema::dropIfExists('recoleccion');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResiduos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residuos', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_municipio',32);            
            $table->string('residuo',150);                  
            $table->float('precio',20,5);      
            $table->string('unidades',150);
            $table->increments('opcion')->start_from(0);
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
        Schema::dropIfExists('residuos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegocios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
           
            
            $table->string('id',32)->unique();
            $table->string('id_generador',32);
            $table->string('id_municipio',32);
            $table->string('negocio',500);
            $table->string('tiponegocio',150);
            $table->string('calle',500);
            $table->string('numeroext',10);
            $table->string('numeroint',10);
            $table->string('colonia',500);
            $table->string('cp',10);
            $table->string('latitud',50);
            $table->string('longitud',50);
            

            $table->string('telefono',50);
            $table->string('celular',50);
            $table->string('correo',100);
           
            
            $table->float('iva',5,2)->default(0.0);
            
            
            
            $table->boolean("verificado")->default(false);
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
        Schema::dropIfExists('negocios');
    }
}

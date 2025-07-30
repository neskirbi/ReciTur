<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->string('id',32)->unique();            
            $table->string('id_administrador',32);

            $table->string('nombreEmpresa',255);
            $table->string('autorizacionRamir',255);
            $table->string('domicilioFiscal',255);
            $table->string('telefono',255);
            $table->string('nombreReceptor',255);
            $table->string('cargoReceptor',255);
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
        Schema::dropIfExists('centros');
    }
}

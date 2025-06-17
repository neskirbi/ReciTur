<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecolecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recolecciones', function (Blueprint $table) {

            $table->string("id",32)->unique();  

            
            $table->string('cliente',150)->default('');
            $table->longtext('firma')->default('');


            $table->string('id_municipio',32);
            $table->string('id_recolector',32);
            $table->string('id_negocio',32);
            $table->string('negocio',500);
            $table->integer('residuo')->default(0);
            $table->integer('contenedor')->default(0);
            $table->float('cantidad',20,2)->default(0);
            $table->float('subtotal',20,2)->default(0);
            $table->float('iva',20,2)->default(0);
            $table->float('total',20,2)->default(0);
            $table->integer('folio')->default(0);

            
            $table->string('transportista',150)->default('');
            $table->string('domiciliot',250)->default('');
            $table->string('ramir',250)->default('');
            $table->string('telefonot',20)->default('');
            $table->string('sctt',30)->default('');
            $table->string('recolector',150)->default('');
            $table->longtext('firmat')->default('');
            $table->string('ruta',50)->default('');
            $table->string('vehiculo',50)->default('');
            $table->string('matriculat',20)->default('');

            
            $table->string('empresar',250)->default('');
            $table->string('ramirr',50)->default('');
            $table->string('domicilior',250)->default('');
            $table->string('telefonor',20)->default('');
            $table->string('nombrer',150)->default('');
            $table->longtext('firmar',250)->default('');
            $table->string('cargor',150)->default('');
            $table->timestamp('fehcallegada');




           
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
        Schema::dropIfExists('recolecciones');
    }
}

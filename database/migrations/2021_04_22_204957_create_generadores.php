<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneradores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generadores', function (Blueprint $table) {
            /**
             * datos del sistema
             */
            $table->string("id",32)->unique();
            $table->string("id_cliente",32);
            /**
             * Fiscales
             */
            $table->string('razonsocial',250)->default('');
            $table->string('fisicaomoral',50)->default('');
            $table->string('rfc',50);
            $table->string('rfcpdf',100)->default('');
            $table->string('calle',500)->default('');
            $table->string('numeroext',20)->default('');
            $table->string('numeroint',20)->default('');
            $table->string('colonia',250)->default('');
            $table->string('entidad',100)->default('');
            $table->string('municipio',150)->default('');
            $table->string('cp',20)->default('');
            $table->string('telefono',50)->default('');
            $table->string('celular',50)->default('');
            $table->string('mail',150)->default('');
            $table->string('mail2',150)->default('');
            /**
             * Representante Persona Moral
             */
            $table->string('nombresrepre',150)->default('');
            $table->string('apellidosrepre',150)->default('');
            $table->string('nacionalidadrepre',100)->default('');
            $table->string('identificacionrepre',50)->default('');
            $table->string('identificacionreprepdf',100)->default('');
            $table->string('rfcrepre',50)->default('');
            $table->string('rfcreprepdf',100)->default('');
            /**
             * Empresa Persona Moral
             */
            $table->string('fechaconst',50)->default('');
            $table->string('numeroactacont',100)->default('');
            $table->string('numeroactacontpdf',100)->default('');
            $table->string('domicilioempresapdf',100)->default('');
            $table->string('notario',250)->default('');
            //$table->string('numeronotario',150)->default('');
            $table->string('numeronotaria',150)->default('');
            $table->string('entidadnotaria',100)->default('');
            /**
             * Persona Fisica
             */
            $table->string('nombresfisica',150)->default('');
            $table->string('apellidosfisica',150)->default('');
            $table->string('nacionalidadfisica',100)->default('');
            $table->string('identificacionfisica',50)->default('');
            $table->string('identificacionfisicapdf',100)->default('');

 /**
  * Verificacion de datos validos
  */
            $table->boolean("verificado")->default(false);
            /**
             * datos del sistema
             */
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
        Schema::dropIfExists('generadores');
    }
}

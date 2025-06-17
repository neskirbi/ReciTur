<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {

            $table->string('id',32)->unique();
            $table->string('id_administrador',32)->default('');
            $table->string('id_cliente',32);
            $table->string('id_obra',32)->default('');
            $table->string('id_negocio',32)->default('');
            $table->string('id_municipio',32);
            $table->float('monto',20,2);
            $table->string('nombre',150);
            $table->string('direccion',500);
            $table->string('cp',20);
            $table->string('municipio',100);
            $table->string('entidad',100);
            $table->string('referencia',100)->default('');
            $table->string('descripcion',50)->default('');
            $table->string('detalle',150)->default('');
            $table->integer('status')->default(1);
            
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
        Schema::dropIfExists('pagos');
    }
}

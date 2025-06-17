<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresastransporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresastransporte', function (Blueprint $table) {
            $table->string("id",32)->unique();            
            $table->string('id_transportista',32);
            $table->string('razonsocial',250);            
            
            $table->string("ramir",100);
            $table->string("regsct",100)->default('');            
            
            $table->longtext('domicilio');

            $table->string('correo',50);
            $table->string('telefono',50);
            $table->string('giro',250); 
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
        Schema::dropIfExists('empresastransporte');
    }
}

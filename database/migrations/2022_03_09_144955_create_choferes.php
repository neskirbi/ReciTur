<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoferes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choferes', function (Blueprint $table) {
            $table->string("id",32)->unique();
            
            $table->string('razonsocial',250); 
            $table->string("ramir",100);            
            $table->string("regsct",100)->default('');   
            $table->string('giro',250); 
            $table->longtext('domicilio');


            $table->string("nombres",150);
            $table->string("apellidos",150);
            $table->string("licencia",150);
            $table->string('telefono',50)->default('');
            $table->string('pass',255)->default('');
            $table->boolean('verificado')->default(0);
            $table->integer('tipo')->default(0);
            
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
        Schema::dropIfExists('choferes');
    }
}

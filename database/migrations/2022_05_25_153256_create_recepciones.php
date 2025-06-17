<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepciones', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_municipio',32);
            $table->string('nombre',150);
            $table->string('cargo',150);
            $table->longtext('firma')->default('');
            $table->string('mail',50);
            $table->string('pass',255);            
            $table->rememberToken();
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
        Schema::dropIfExists('recepciones');
    }
}

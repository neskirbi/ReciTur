<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->string("id",32)->unique();
            $table->string("nombres",150);
            $table->string("apellidos",150);
            $table->string("mail",150)->unique();
            $table->boolean("accept")->default(false);
            $table->string("pass",150);
            $table->boolean('confirmacion')->default(0);
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
        Schema::dropIfExists('clientes');
    }
}

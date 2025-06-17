<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_municipio',32);
            $table->string('razonsocial',250)->default('');
            $table->float('iva',5,2)->default(0);
            $table->string('banco',50)->default('');
            $table->string('cuenta',20)->default('');
            $table->string('clabe',20)->default('');
            $table->string('referencia',10)->default('');
            $table->integer('folio')->default(0);
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
        Schema::dropIfExists('configuraciones');
    }
}

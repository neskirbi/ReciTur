<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedemas', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('nombre',150);
            $table->string('cargo',150);
            $table->string('mail',150);
            $table->string('pass',20);
            $table->integer('principal')->default(0);
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
        Schema::dropIfExists('sedemas');
    }
}

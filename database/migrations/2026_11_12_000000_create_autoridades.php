<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoridades extends Migration
{
    public function up()
    {
        Schema::create('autoridades', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('autoridad', 150);
            $table->string('cargo', 150)->default('');
            $table->string('mail', 50)->unique();
            $table->string('pass', 255);
            $table->rememberToken();
            $table->timestamps();
            $table->string('temp', 20)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('autoridades');
    }
}
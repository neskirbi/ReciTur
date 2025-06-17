<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportistas', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('transportista',150);
            $table->string('mail',150);
            $table->string('pass',255);
            $table->boolean('confirmacion')->default(0);
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
        Schema::dropIfExists('transportistas');
    }
}

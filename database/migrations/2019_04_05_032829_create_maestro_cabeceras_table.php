<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestroCabecerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestro_cabeceras', function (Blueprint $table) {
            $table->bigIncrements('n_id');
            $table->string('t_nombre',100);
            $table->string('t_descripcion',256)->nullable();
            $table->boolean('l_estado')->default(1);
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
        Schema::dropIfExists('maestro_cabeceras');
    }
}

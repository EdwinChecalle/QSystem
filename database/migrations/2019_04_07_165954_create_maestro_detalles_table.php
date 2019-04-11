<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestroDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestro_detalles', function (Blueprint $table) {
            $table->bigIncrements('n_id');
            $table->unsignedBigInteger('n_id_maestrocabecera');
            $table->string('c_codigodetalle', 10)->nullable();
            $table->string('t_nombre', 50)->unique();
            $table->string('t_nombrecorto', 25)->nullable();
            $table->string('t_referencia', 10)->nullable();
            $table->boolean('l_estado')->default(1);
            $table->timestamps();
            $table->foreign('n_id_maestrocabecera')->references('n_id')->on('maestro_cabeceras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maestro_detalles');
    }
}

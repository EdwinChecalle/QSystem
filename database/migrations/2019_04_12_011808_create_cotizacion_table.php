<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->bigIncrements('n_id');
            $table->integer('n_tabla_tipoprenda')->nullable();
            $table->string('c_tipoprenda',10)->nullable();
            $table->integer('n_tabla_modeloprenda')->nullable();
            $table->string('c_modeloprenda',10)->nullable();
            $table->integer('n_tabla_tipotela')->nullable();
            $table->string('c_tipotela',10)->nullable();
            $table->integer('n_tabla_tonotela')->nullable();
            $table->string('c_tonotela',10)->nullable();
            $table->integer('n_tabla_tenidotela')->nullable();
            $table->string('c_tenidotela',10)->nullable();
            $table->integer('n_tabla_grosortela')->nullable();
            $table->string('c_grosortela',10)->nullable();
            $table->decimal('n_precio', 8, 2);
            $table->string('t_descripcion')->nullable();
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
        Schema::dropIfExists('cotizacion');
    }
}

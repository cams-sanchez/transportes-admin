<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientosCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos_catalogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tipo', 100);
            $table->string('nombre',200);
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6);
            $table->string('estado', 50);
            $table->string('municipio', 100);
            $table->mediumText('ubicacion_gps');
            $table->string('encargado_recibir', 200);
            $table->mediumText('contacto');
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
        Schema::dropIfExists('establecimientos_catalogs');
    }
}
